<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert departments with provided courses
        DB::table('departments')->insert([
            ['id' => 1, 'name' => 'Department 1', 'course' => 'Bachelor of Science in Chemical Engineering'],
            ['id' => 2, 'name' => 'Department 2', 'course' => 'Bachelor of Science in Information Technology'],
            ['id' => 3, 'name' => 'Department 3', 'course' => 'Bachelor of Science in Nursing'],
            ['id' => 4, 'name' => 'Department 4', 'course' => 'Caregiving NC II'],
            ['id' => 5, 'name' => 'Department 5', 'course' => 'Bachelor of Elementary Education'],
            ['id' => 6, 'name' => 'Department 6', 'course' => 'Bachelor of Secondary Education'],
            ['id' => 7, 'name' => 'Department 7', 'course' => 'Bachelor of Science in Business Administration'],
            ['id' => 8, 'name' => 'Department 8', 'course' => 'Bachelor of Science in Accountancy'],
            ['id' => 9, 'name' => 'Department 9', 'course' => 'Bachelor of Science in Entrepreneurship'],
            ['id' => 10, 'name' => 'Department 10', 'course' => 'Bachelor of Science in Accountancy'],
            ['id' => 11, 'name' => 'Department 11', 'course' => 'Bachelor of Science in Entrepreneurship'],
            ['id' => 12, 'name' => 'Department 12', 'course' => 'Bachelor of Science in Accounting Management'],
            ['id' => 13, 'name' => 'Department 13', 'course' => 'Bachelor of Science in Accounting Information System'],
        ]);

        // Check if teacher data exists and assign teachers to departments
        $teacherExists = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'teacher')
            ->whereIn('users.id', [1, 2])
            ->exists();

        if ($teacherExists) {
            DB::table('department_teachers')->insert([
                ['department_id' => 1, 'teacher_id' => 1],
                ['department_id' => 2, 'teacher_id' => 2],
            ]);
        }

        // Check if student data exists and assign students to departments
        $studentExists = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'student')
            ->whereIn('users.id', [1, 2])
            ->exists();

        if ($studentExists) {
            DB::table('department_students')->insert([
                ['department_id' => 1, 'student_id' => 1],
                ['department_id' => 2, 'student_id' => 2],
            ]);
        }

        // Optionally, you can create additional departments using factories if needed
        // Department::factory()->count(10)->create();
    }
}
