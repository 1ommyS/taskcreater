<?php

namespace App\Services\Implementations;

use App\Models\CompletedTasks;
use App\Models\GroupTasks;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskService implements ITaskService
{
    public function getTasks (int $count): \Illuminate\Database\Eloquent\Collection|array
    {
        return Task::query()->limit($count)->get();
    }


    public function createTask (int $amount, $lab_id, array $types, array $encoding_types, array $memory_types, array $values)
    {
        for ( $i = 0; $i < $amount; $i++ ) {
            $text = rand(1, 3);
            $graphic = rand(1, 2);
            switch ( $text ) {
                case 1:
                    $this->generateFirstTypeOfTextTasks($memory_types, 1, $values, $encoding_types, $lab_id);
                    break;
                case 2:
                    $this->generateSecondTypeOfTextTasks($lab_id);
                    break;
                case 3:
                    $this->generateThirdTypeOfTextTasks($lab_id);
                    break;
            }
            switch ( $graphic ) {
                case 1:
                    $this->generateFirstTypeOfGraphicTasks($lab_id);
                    break;
                case 2:
                    $this->generateSecondTypeOfGraphicTasks($lab_id);
                    break;
            }
            $this->generateFirstTypeOfAudioTasks($lab_id);
            //foreach ( $types as $key => $type ) {
            //    if ( $type == "text" ) {
            //
            //        $this->generateFirstTypeOfTextTasks($memory_types, $key, $values, $encoding_types, $lab_id);
            //        $this->generateSecondTypeOfTextTasks($lab_id);
            //        $this->generateThirdTypeOfTextTasks($lab_id);
            //
            //    } else if ( $type == "graphic" ) {
            //        $this->generateFirstTypeOfGraphicTasks($lab_id);
            //        $this->generateSecondTypeOfGraphicTasks($lab_id);
            //    } else if ( $type == "audio" ) {
            //        $this->generateFirstTypeOfAudioTasks($lab_id);
            //    }
            //}
        }
    }

    public function checkAnswers (int $lab_id, $answers, int $student_id)
    {
        foreach ( $answers as $id => $answer ) {
            $task = Task::find((int) $id);
            if ( $task->answer == $answer ) $correct = true;
            else $correct = false;
            CompletedTasks::query()->create([
                "user_answer" => $answer,
                "student_id" => $student_id,
                "task_id" => $id,
                "is_correct" => $correct,
                "lab_id" => $lab_id,
            ]);
        }
    }

    public function assignTasksToGroup (int $group_id, array $tasks_id)
    {
        foreach ( $tasks_id as $current_id ) {
            GroupTasks::query()->create([
                "group_id" => $group_id,
                "task_id" => $current_id,
            ]);
        }
    }

    /**
     * @param array $memory_types
     * @param int|string $key
     * @param array $values
     * @param array $encoding_types
     * @param $lab_id
     * @return array
     */
    private function generateFirstTypeOfTextTasks (array $memory_types, int|string $key, array $values, array $encoding_types, $lab_id): void
    {
        $question = "Сколько {$memory_types[$key]} займет слово(предложение) \"{$values[$key]}\" в кодировке {$encoding_types[$key]}";
        $weight = 0;
        switch ( $encoding_types[$key] ) {
            case "ASCII":
                $weight = 8;
                break;
            case "UTF-8":
                $weight = 8;
                break;
            case "КОИ8":
                $weight = 8;
                break;
            case "UTF-16":
                $weight = 16;
                break;
            case "UTF-32":
                $weight = 32;
                break;
        }
        $word_weight = strlen($values[$key]) * $weight;
        $answer = 0;
        switch ( $memory_types[$key] ) {
            case "Бит":
                $answer = $word_weight;
                break;
            case "Байт":
                $answer = $word_weight / 8;
                break;
            case "Кбайт":
                $answer = $word_weight / 1024 / 8;
                break;
            case "Мбайт":
                $answer = $word_weight / (1024 * 1024 * 8);
                break;
        }
        Task::query()->create([
            "question" => $question,
            "answer" => $answer,
            "lab_id" => $lab_id,
        ]);
    }

    /**
     * @param $lab_id
     * @return void
     */
    private function generateSecondTypeOfTextTasks ($lab_id): void
    {
        $value = rand(1, 50);
        $memory_type = (int) rand(1, 4);
        $koef = 1;
        switch ( $memory_type ) {
            case 1:
                $memory_type = "Бит";
                break;
            case 2:
                $memory_type = "Байт";
                $koef = 8;
                break;
            case 3:
                $memory_type = "Кбайт";
                $koef = 1024 * 8;
                break;
            case 4:
                $memory_type = "Мбайт";
                $koef = 1024 * 1024 * 8;
                break;
        }
        $question = "Текст занимает {$value} {$memory_type} памяти компьютера. Сколько символов содержит этот текст?";
        $answer = $value * $koef / 8;
        Task::query()->create([
            "question" => $question,
            "answer" => $answer,
            "lab_id" => $lab_id,
        ]);
    }

    /**
     * @param $lab_id
     * @return void
     */
    private function generateThirdTypeOfTextTasks ($lab_id): void
    {
        $pages = rand(1, 1000);
        $rows = rand(1, 1000);
        $symbols = rand(1, 1000);
        $answer = $pages * $rows * $symbols;
        $question = "Текст занимает полных {$pages} страниц. На каждой странице размещается {$rows} строк по {$symbols} символов в строке. Какой объем оперативной памяти (в байтах) займет этот текст?";
        Task::query()->create([
            "question" => $question,
            "answer" => $answer,
            "lab_id" => $lab_id,
        ]);
    }

    /**
     * @param $lab_id
     * @return array
     */
    private function generateFirstTypeOfGraphicTasks ($lab_id): void
    {
        $exp = rand(2, 15);
        $colors = pow(2, $exp);
        $question = "Найдите глубину цвета, если количество цветов в палитре {$colors}";
        $answer = $exp;
        Task::query()->create([
            "question" => $question,
            "answer" => $answer,
            "lab_id" => $lab_id,
        ]);
    }

    /**
     * @param $lab_id
     * @return void
     */
    private function generateSecondTypeOfGraphicTasks ($lab_id): void
    {
        $glub = rand(1, 50);
        $w = rand(100, 10000);
        $l = rand(100, 10000);
        $question = "Какой объём информации занимает растровое  изображение размером {$w} х {$l} пикселей с глубиной цвета {$glub} бит";
        $answer = $w * $l * $glub;
        Task::query()->create([
            "question" => $question,
            "answer" => $answer,
            "lab_id" => $lab_id,
        ]);
    }

    /**
     * @param $lab_id
     * @return void
     */
    private function generateFirstTypeOfAudioTasks ($lab_id): void
    {
        $format = rand(1, 4);
        if ( $format == 3 ) $format = 4;
        $length = rand(1, 30);
        $step_kodir = rand(1, 100);
        $frequency = rand(1, 500);
        $question = "Производится {$format}канальная звукозапись с частотой дискретизации {$frequency} кГц. Запись длится {$length}, её результаты записываются в файл без сжатия данных, причём каждый сигнал кодируется минимально возможным и одинаковым количеством бит. Битовая глубина звука {$step_kodir}. Определите размер в байтах.";
        $answer = $format * $frequency * $length * 60 * $step_kodir;
        Task::query()->create([
            "question" => $question,
            "answer" => $answer,
            "lab_id" => $lab_id,
        ]);
    }

    public function getVariants (int $lab_id)
    {
        return Task::query()->where("lab_id", $lab_id)->get();
    }
}