<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateScheduleRequest;
use App\Models\Lesson;
use App\Models\Schedule;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * @param Request $request
     * @param string $day
     * @return JsonResponse
     */
    public function get(Request $request, string $day): JsonResponse
    {
        $user = $request->user();

        $schedules = Schedule::query()->where('day', $day)->where('group_id', $user->group_id)->get()->toArray();

        foreach ($schedules as $key => $value) {
            $lesson = Lesson::query()->find($value['lesson_id'])->toArray();

            $schedules[$key]['lesson'] = $lesson['name'];
            $schedules[$key]['type'] = Type::query()->find($value['type_id'])->first()['name'];
            $schedules[$key]['teacher'] = User::query()->find($lesson['teacher_id'])->first()['name'];
        }

        return response()->json($schedules);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAll(Request $request): JsonResponse
    {
        $schedules = Schedule::query()->where('group_id', $request->user()->group_id)->get();

        foreach ($schedules as $key => $value) {
            $lesson = Lesson::query()->find($value['lesson_id'])->toArray();

            $schedules[$key]['lesson'] = $lesson['name'];
            $schedules[$key]['type'] = Type::query()->find($value['type_id'])->first()['name'];
            $schedules[$key]['teacher'] = User::query()->find($lesson['teacher_id'])->first()['name'];
        }

        return response()->json($schedules);
    }

    /**
     * @param CreateScheduleRequest $request
     * @return JsonResponse
     */
    public function add(CreateScheduleRequest $request): JsonResponse
    {
        $data = $request->validated();

        if(!isset($data['group_id'])) {
            $data['group_id'] = $request->user()->group_id;
        }

        Schedule::query()->create($data);

        return response()->json([
            'message' => 'schedule_created'
        ]);
    }
}
