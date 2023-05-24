<?php

namespace App\Http\Controllers;

use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SchedulerController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
//        echo '<pre>'; print_r(date('Y-F-d')); echo '</pre>';

        return inertia('Scheduler', [
            'dateFrom' => date('Y-m-d'),
            'items' => [
                [
                    'id' => 1,
                    'name' => 'Номер 1',
                    'load' => [
                        [
                            'name' => 'Иван Которин',
                            'startDate' => '2023-05-23',
                            'duration' => 2,
                            'people' => 2,
                        ],
                        [
                            'name' => 'Кирилл Рева',
                            'startDate' => '2023-05-25',
                            'duration' => 2,
                            'people' => 1,
                        ],
                        [
                            'name' => 'Иван Которин',
                            'startDate' => '2023-05-28',
                            'duration' => 1,
                            'people' => 1,
                        ],
                        [
                            'name' => 'Кирилл Рева',
                            'startDate' => '2023-05-29',
                            'duration' => 3,
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
                            'startDate' => '2023-05-24',
                            'duration' => 1,
                            'people' => 1,
                        ],
                        [
                            'name' => 'Кирилл Рева',
                            'startDate' => '2023-05-29',
                            'duration' => 1,
                            'people' => 1,
                        ],
                        [
                            'name' => 'Иван Которин',
                            'startDate' => '2023-05-30',
                            'duration' => 1,
                            'people' => 1,
                        ],
                    ]
                ],
                [
                    'id' => 3,
                    'name' => 'Номер 3',
                    'load' => [],
                ]
            ],
        ]);
    }
}
