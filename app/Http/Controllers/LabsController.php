<?php

namespace App\Http\Controllers;

use App\Models\CompletedTasks;
use App\Models\Lab;
use App\Models\Mark;
use App\Models\StudentGroups;
use App\Models\Task;
use App\Models\User;
use App\Services\Implementations\TaskService;
use Brick\Math\Exception\DivisionByZeroException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LabsController extends Controller
{


    /**
     * @param \App\Services\Implementations\TaskService $taskService
     */
    public function __construct (private TaskService $taskService) { }

    public function viewTasks (int $id)
    {
        $tasks = Task::query()->select("id", "answer", "question")->where("lab_id", $id)->get();
        //dd($tasks);
        return view("pages.labs.tasks_with_answers", compact("tasks"));
    }

    public function viewMarks (int $id)
    {
        $group_id = Lab::findOrFail($id)->group_id;
        $student_ids = StudentGroups::query()->where("group_id", $group_id)->get("student_id");
        $marks = [];
        foreach ( $student_ids as $object ) {
            $studentId = $object->student_id;
            $name = User::find($studentId)->name;
            $all_counts = count(CompletedTasks::query()->where("lab_id", $id)->get());
            $correct_answers = count(CompletedTasks::query()->where([["is_correct", 1], ["lab_id", $id], ["student_id", $studentId]])->get());
            $mark = $this->getMark($correct_answers, $all_counts);
            $marks[$name] = $mark;
        }
        return view("pages.labs.marks", compact("marks"));
    }

    public function viewLabs (int $id)
    {
        $labs = Lab::query()->where("group_id", $id)->get();
        $marks = [];
        foreach ( $labs as $lab ) {
            $all_counts = count(CompletedTasks::query()->where("lab_id", $lab->id)->get());
            $correct_answers = count(CompletedTasks::query()->where([["is_correct", 1], ["lab_id", $lab->id], ["student_id", Auth::id()]])->get());
            $mark = Mark::query()->where([["student_id", Auth::id()], ["lab_id", $lab->id]])->get();
            $marks[$lab->id] = $mark;
        }
        $labs_objects = CompletedTasks::query()->select("lab_id")->where("student_id", Auth::id())->get("lab_id");
        $completed_labs = [];
        foreach ( $labs_objects as $lab_id ) {
            if ( !in_array($lab_id->lab_id, $completed_labs) ) $completed_labs[] = $lab_id->lab_id;
        }
        return view("pages.labs.tasks", compact("labs", "marks", "completed_labs"));
    }

    public function getLabsInGroup (int $id)
    {
        $labs = Lab::query()->where("group_id", $id)->get();
        return view("pages.labs.group", compact("labs", "id"));
    }

    public function completeLab (int $id)
    {
        $lab = Lab::findOrFail($id);
        $tasks = Task::query()->where("lab_id", $id)->get();
        return view("pages.labs.complete", compact("tasks", "lab"));
    }

    public function checkAnswers (Request $request, int $id)
    {
        $lab = Lab::findOrFail($id);
        $tasks = Task::query()->where("lab_id", $id)->get();
        $answers = $request->except("_token");
        $keys = [];
        foreach ( $answers as $k => $answer ) {
            $keys[] = $k;
        }
        $this->taskService->checkAnswers($id, $answers, Auth::id());
        $checked_answers = CompletedTasks::query()->whereIn("task_id", $keys)->get();
        $all_counts = count($checked_answers);
        $correct_answers = count(CompletedTasks::query()->whereIn("task_id", $keys)->where("is_correct", 1)->get());
        $mark = $this->getMark($correct_answers, $all_counts);
        Mark::query()->create(["student_id" => Auth::id(), "lab_id" => $id, "mark" => $mark]);
        return view("pages.labs.complete", compact("tasks", "checked_answers", "lab", "mark"));
    }

    public function createLabView (int $id)
    {
        return view("pages.labs.create");
    }

    public function save (Request $request, int $id)
    {
        Lab::query()->create(["group_id" => $id, "lab_name" => $request->lab_name]);
        $lab_id = Lab::query()->where([["group_id", $id], ["lab_name", $request->lab_name]])->first()->id;
        $types = ["text", "graphic", "audio"];
        $values = [$request->word_1, $request->sentence];
        $encoding_types = [$request->encoding_type_one, $request->encoding_type_second];
        $memory_types = [$request->memory_type_one, $request->memory_type_second];
        $amount = $request->amount;

        $this->taskService->createTask(amount: $request->amount, lab_id: $lab_id, types: $types, encoding_types: $encoding_types, memory_types: $memory_types, values: $values);
        return to_route("preview_variants", [$lab_id, $amount]);
    }

    public function previewVariants (int $id, int $amount)
    {
        $variants_to_accept = $this->taskService->getVariants(lab_id: $id);
        $first_id = $variants_to_accept[0]->id;
        $last_id = $variants_to_accept[count($variants_to_accept) - 1]->id;
        return view("pages.labs.choose_variant", compact("variants_to_accept", "first_id", "last_id", "amount"));
    }

    public function chooseVariant (Request $request, int $id, int $amount)
    {
        $id_start = $id_end = 0;
        foreach ( $request->all() as $key => $value ) {
            if ( $key != "_token" ) {
                $id_start = (int) explode("-", $key)[0];
                $id_end = (int) explode("-", $key)[1];
            }
        }
        Task::query()->where([
            ["lab_id", $id],
            ["id", "<=", $id_start],
        ])->delete();
        Task::query()->where([
            ["lab_id", $id],
            ["id", ">", $id_end],
        ])->delete();
        //dd($id_start, $id_end, $id, Task::query()->where([
        //    ["lab_id", $id],
        //    ["id", "<=", $id_start]])->get());
        $group_id = Lab::query()->where("id", $id)->first()->group_id;

        return to_route("teacher.labs.list", $group_id);
    }

    /**
     * @param int $correct_answers
     * @param int $all_counts
     * @return int
     */
    private function getMark (int $correct_answers, int $all_counts): int
    {
        try {
            $percent = $correct_answers * 100 / $all_counts;
            $mark = 0;
            if ( $percent >= 86 ) $mark = 5;
            else if ( $percent <= 85 and $percent >= 66 ) $mark = 4;
            else if ( $percent >= 41 and $percent <= 65 ) $mark = 3;
            else $mark = 2;
            return $mark;
        } catch ( \DivisionByZeroError $exception ) {
            return 0;
        }
    }
}
