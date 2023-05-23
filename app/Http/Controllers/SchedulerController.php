<?php

namespace App\Http\Controllers;

use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SchedulerController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
//        echo '<pre>'; print_r(App::getLocale()); echo '</pre>';

        return inertia('Scheduler', [
            'dateFrom' => date('Y-F-d'),
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
