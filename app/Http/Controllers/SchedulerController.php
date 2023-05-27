<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Nette\Utils\Random;

class SchedulerController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        /*$client = new Client();

        $client->name = 'hello';
        $client->family = 'hello';
        $client->surname = 'hello';
        $client->email = 'test@mail.ru';
        $client->phone = '+79520025704';

        $client->save();

        Client::query()->create([
            'name' => 'hello',
        ]);*/
//        Client::query()->create([
//            'name' => 'hello',
//        ]);

        $longDurationColors = [
            '#e8fcdb',
            '#EEF2CB',
            '#E6E9D1',
        ];

        /*function getRandomColor(array $longDurationColors): string
        {
            $randIndex = floor(rand() * count($longDurationColors));

            return $longDurationColors[$randIndex];
        }*/


        return inertia('Scheduler', [
            'dateFrom' => date('Y-m-d'),
            'items' => [
                [
                    'id' => 1,
                    'name' => 'Номер 1',
                    'load' => [
                        [
                            'id' => 1,
                            'name' => 'Иван Которин1',
                            'startDate' => '2023-05-23',
                            'endDate' => '2023-05-26',
                            'bgColor' => '#EEF2CB',
                            'people' => 2,
                        ],
                        [
                            'id' => 2,
                            'name' => 'Кирилл Рева1',
                            'startDate' => '2023-05-26',
                            'endDate' => '2023-05-28',
                            'bgColor' => '#E6E9D1',
                            'people' => 1,
                        ],
                        [
                            'id' => 3,
                            'name' => 'Иван Которин2',
                            'startDate' => '2023-05-28',
                            'endDate' => '2023-05-29',
                            'people' => 1,
                        ],
                        [
                            'name' => 'Кирилл Рева2',
                            'startDate' => '2023-05-29',
                            'endDate' => '2023-06-01',
                            'bgColor' => '#e8fcdb',
                            'people' => 1,
                        ],
                    ]
                ],
                [
                    'id' => 2,
                    'name' => 'Номер 2',
                    'load' => [
                        [
                            'id' => 1,
                            'name' => 'Иван Которин3',
                            'startDate' => '2023-05-24',
                            'endDate' => '2023-05-25',
                            'people' => 1,
                        ],
                        [
                            'id' => 2,
                            'name' => 'Кирилл Рева3',
                            'startDate' => '2023-05-29',
                            'endDate' => '2023-05-30',
                            'people' => 1,
                        ],
                        [
                            'id' => 3,
                            'name' => 'Иван Которин4',
                            'startDate' => '2023-05-30',
                            'endDate' => '2023-05-31',
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
