<?php

namespace App\Http\Controllers;

use DateInterval;
use Illuminate\Http\Request;

class SchedulerController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {

        $currentDate = new \DateTime();

//        echo '<pre>'; print_r($currentDate); echo '</pre>';

        $dateFormat = 'd D';
        $dateColumn[] = $currentDate->format($dateFormat);

        $interval = $interval = DateInterval::createFromDateString('1 day');
        for ($i = 0; $i < 7; $i++) {
            $currentDate->add($interval);
            $dateColumn[] = $currentDate->format($dateFormat);
        }

        echo '<pre>'; print_r($dateColumn); echo '</pre>';

        return inertia('Scheduler', [
            'dateFrom' => date('d F Y'),
            'dateColumn' => [],
            'items' => [
                [
                    'id' => 1,
                    'name' => 'Номер 1',
                    'load' => [
                        [
                            'name' => 'Иван Которин',
                            'duration' => 1,
                            'people' => 2,
                        ],
                        [
                            'name' => 'Кирилл Рева',
                            'duration' => 1,
                            'people' => 1,
                        ],
                        [
                            'name' => 'Иван Которин',
                            'duration' => 1,
                            'people' => 1,
                        ],
                        [
                            'name' => 'Кирилл Рева',
                            'duration' => 1,
                            'people' => 1,
                        ],
                        [
                            'name' => 'Иван Которин',
                            'duration' => 1,
                            'people' => 1,
                        ],
                        [
                            'name' => 'Кирилл Рева',
                            'duration' => 1,
                            'people' => 1,
                        ],
                        [
                            'name' => 'Иван Которин',
                            'duration' => 1,
                            'people' => 1,
                        ],
                    ]
                ],
                [
                    'id' => 2,
                    'name' => 'Номер 2',
                    'load' => [
                        [
                            'name' => 'Иван Которин',
                            'duration' => 1,
                            'people' => 2,
                        ],
                        [
                            'name' => 'Кирилл Рева',
                            'duration' => 1,
                            'people' => 1,
                        ],
                        [
                            'name' => 'Иван Которин',
                            'duration' => 1,
                            'people' => 1,
                        ],
                        [
                            'name' => 'Кирилл Рева',
                            'duration' => 1,
                            'people' => 1,
                        ],
                        [
                            'name' => 'Иван Которин',
                            'duration' => 1,
                            'people' => 1,
                        ],
                        [
                            'name' => 'Кирилл Рева',
                            'duration' => 1,
                            'people' => 1,
                        ],
                        [
                            'name' => 'Иван Которин',
                            'duration' => 1,
                            'people' => 1,
                        ],
                    ]
                ],
            ],
        ]);
    }
}
