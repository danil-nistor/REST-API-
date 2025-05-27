<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Block;
use App\Models\Subject;
use App\Models\Speciality;
use App\Models\Department;
use App\Models\EduForm;
use App\Models\Competence;
use App\Models\TitlePlan;
use App\Models\EduPlan;
use App\Models\Load;
use App\Models\EmplLoad;
use App\Models\EmplLoadStream;
use App\Models\Employee;
use App\Models\EduPlanCompetency;
use App\Models\FormControl;
use App\Models\EduPlanFormControl;
use App\Models\Group;
use App\Models\SubjectForm;
use App\Models\EduSemester;

class DataApiController extends Controller
{
    private function getTableData(string $tableName): array
    {
        if (Schema::hasTable($tableName)) {
            return DB::table($tableName)->get()->toArray();
        }

        return [];
    }
    // Экспорт данных

    public function export()
    {
        try{
            $data = [
                'block' => $this->getTableData('block'),
                'competence' => $this->getTableData('competence'),
                'departments' => $this->getTableData('departments'),
                'edu_forms' => $this->getTableData('edu_forms'),
                'edu_plan' => $this->getTableData('edu_plan'),
                'edu_plan_competencies' => $this->getTableData('edu_plan_competencies'),
                'edu_plan_form_control' => $this->getTableData('edu_plan_form_control'),
                'edu_semesters' => $this->getTableData('edu_semesters'),
                'empl_loads' => $this->getTableData('empl_loads'),
                'empl_loads_streams' => $this->getTableData('empl_loads_streams'),
                'employees' => $this->getTableData('employees'),
                'form_control' => $this->getTableData('form_control'),
                'groups' => $this->getTableData('groups'),
                'loads' => $this->getTableData('loads'),
                'speciality' => $this->getTableData('speciality'),
                'subjects' => $this->getTableData('subjects'),
                'subject_forms' => $this->getTableData('subject_forms'),
                'title_plan' => $this->getTableData('title_plan'),
            ];
            /*$data = [
                'block' => Block::all(),
                'competence' => Competence::all(),
                'departments' => Department::all(),
                'edu_forms' => EduForm::all(),
                'edu_plan' => EduPlan::all(),
                'edu_plan_competencies' => EduPlanCompetency::all(),
                'edu_plan_form_control' => EduPlanFormControl::all(),
                'edu_semesters' => EduSemester::all(),
                'empl_loads' => EmplLoad::all(),
                'empl_loads_streams' => EmplLoadStream::all(),
                'employees' => Employee::all(),
                'form_control' => FormControl::all(),
                'groups' => Group::all(),
                'loads' => Load::all(),
                'speciality' => Speciality::all(),
                'subjects' => Subject::all(),
                'subject_forms' => SubjectForm::all(),
                'title_plan' => TitlePlan::all(),
            ];*/

        return response()->json($data);
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => 'Ошибка при экспорте данных: ' . $e->getMessage()], 500);
        }
    }

    // Импорт данных
    public function import(Request $request)
    {
            $data = $request->validate([
        'block' => 'sometimes|array',
        'competence' => 'sometimes|array',
        'departments' => 'sometimes|array',
        'edu_forms' => 'sometimes|array',
        'edu_plan' => 'sometimes|array',
        'edu_plan_competencies' => 'sometimes|array',
        'edu_plan_form_control' => 'sometimes|array',
        'edu_semesters' => 'sometimes|array',
        'empl_loads' => 'sometimes|array',
        'empl_loads_streams' => 'sometimes|array',
        'employees' => 'sometimes|array',
        'form_control' => 'sometimes|array',
        'groups' => 'sometimes|array',
        'loads' => 'sometimes|array',
        'speciality' => 'sometimes|array',
        'subjects' => 'sometimes|array',
        'subject_forms' => 'sometimes|array',
        'title_plan' => 'sometimes|array',
    ]);

    DB::beginTransaction();

        try {
            // Функция для фильтрации null-значений
            $filterNullValues = function ($item) {
                return array_filter($item, fn($value) => $value !== null);
            };

            // Список моделей и дефолтных значений
            $models = [
                'block' => [Block::class, ['part_title' => '']],
                'departments' => [Department::class, ['about' => '']],
                'competence' => [Competence::class, []],
                'edu_forms' => [EduForm::class, []],
                'edu_plan' => [EduPlan::class, []],
                'edu_plan_competencies' => [EduPlanCompetency::class, []],
                'edu_plan_form_control' => [EduPlanFormControl::class, []],
                'edu_semesters' => [EduSemester::class, []],
                'empl_loads' => [EmplLoad::class, []],
                'empl_loads_streams' => [EmplLoadStream::class, []],
                'employees' => [Employee::class, []],
                'form_control' => [FormControl::class, []],
                'groups' => [Group::class, []],
                'loads' => [Load::class, []],
                'speciality' => [Speciality::class, []],
                'subjects' => [Subject::class, []],
                'subject_forms' => [SubjectForm::class, []],
                'title_plan' => [TitlePlan::class, []],
            ];

            foreach ($models as $key => [$modelClass, $defaults]) {
                if (!empty($data[$key])) {
                    foreach ($data[$key] as $item) {
                        // Применяем дефолтные значения
                        $item = array_merge($defaults, $item);

                        // Фильтруем null-значения
                        $filtered = $filterNullValues($item);

                        // Обновляем или создаем запись
                        $record = $modelClass::find($item['id']);
                        if ($record) {
                            $record->fill($filtered);
                            $record->save();
                        } else {
                            $modelClass::create($filtered);
                        }
                    }
                }
            }

            DB::commit();
            return response()->json(['status' => 'success']);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }

            /*
            $data = $request->validate([
                'block' => 'sometimes|array',
                'competence' => 'sometimes|array',
                'departments' => 'sometimes|array',
                'edu_forms' => 'sometimes|array',
                'edu_plan' => 'sometimes|array',
                'edu_plan_competencies' => 'sometimes|array',
                'edu_plan_form_control' => 'sometimes|array',
                'edu_semesters' => 'sometimes|array',
                'empl_loads' => 'sometimes|array',
                'empl_loads_streams' => 'sometimes|array',
                'employees' => 'sometimes|array',
                'form_control' => 'sometimes|array',
                'groups' => 'sometimes|array',
                'loads' => 'sometimes|array',
                'speciality' => 'sometimes|array',
                'subjects' => 'sometimes|array',
                'subject_forms' => 'sometimes|array',
                'title_plan' => 'sometimes|array',
            ]);

                DB::beginTransaction();
            try {
                foreach ($data['block'] as $item) {
                    $item['part_title'] = $item['part_title'] ?? '';
                    Block::updateOrCreate(['id' => $item['id']], $item);
                }

                foreach ($data['competence'] as $item) {
                    Competence::updateOrCreate(['id' => $item['id']], $item);
                }

                foreach ($data['departments'] as $item) {
                    $item['about'] = $item['about'] ?? '';
                    Department::updateOrCreate(['id' => $item['id']], $item);
                }

                foreach ($data['edu_forms'] as $item) {
                    EduForm::updateOrCreate(['id' => $item['id']], $item);
                }

                foreach ($data['edu_plan'] as $item) {
                    EduPlan::updateOrCreate(['id' => $item['id']], $item);
                }

                foreach ($data['edu_plan_competencies'] as $item) {
                    EduPlanCompetency::updateOrCreate(['id' => $item['id']], $item);
                }

                foreach ($data['edu_plan_form_control'] as $item) {
                    EduPlanFormControl::updateOrCreate(['id' => $item['id']], $item);
                }

                foreach ($data['edu_semesters'] as $item) {
                    EduSemester::updateOrCreate(['id' => $item['id']], $item);
                }

                foreach ($data['empl_loads'] as $item) {
                    EmplLoad::updateOrCreate(['id' => $item['id']], $item);
                }

                foreach ($data['empl_loads_streams'] as $item) {
                    EmplLoadStream::updateOrCreate(['id' => $item['id']], $item);
                }

                foreach ($data['employees'] as $item) {
                    Employee::updateOrCreate(['id' => $item['id']], $item);
                }

                foreach ($data['form_control'] as $item) {
                    FormControl::updateOrCreate(['id' => $item['id']], $item);
                }

                foreach ($data['groups'] as $item) {
                    Group::updateOrCreate(['id' => $item['id']], $item);
                }

                foreach ($data['loads'] as $item) {
                    Load::updateOrCreate(['id' => $item['id']], $item);
                }

                foreach ($data['speciality'] as $item) {
                    Speciality::updateOrCreate(['id' => $item['id']], $item);
                }

                foreach ($data['subjects'] as $item) {
                    Subject::updateOrCreate(['id' => $item['id']], $item);
                }

                foreach ($data['subject_forms'] as $item) {
                    SubjectForm::updateOrCreate(['id' => $item['id']], $item);
                }

                foreach ($data['title_plan'] as $item) {
                    TitlePlan::updateOrCreate(['id' => $item['id']], $item);
                }

                DB::commit();
                return response()->json(['status' => 'success']);
            }
            catch (\Exception $e)
            {
                DB::rollBack();
                return response()->json(['error' => $e->getMessage()], 500);
            }*/
    }
}
