<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert subjects and connect them with department_id
        Subject::insert([
            // Department 1 - Courses
            [
                'id' => 1,
                'name' => 'Mathematics Calculus',
                'code' => 'MATH101',
                'description' => 'Calculus for Engineering students',
                'is_active' => true,
                'department_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Mathematics Algebra',
                'code' => 'MATH102',
                'description' => 'Algebra for Engineering students',
                'is_active' => true,
                'department_id' => 1,
            ],
            [
                'id' => 3,
                'name' => 'Mathematics Trigonometry',
                'code' => 'MATH103',
                'description' => 'Trigonometry for Engineering students',
                'is_active' => true,
                'department_id' => 1,
            ],
            [
                'id' => 4,
                'name' => 'Physics with Calculus 1',
                'code' => 'PHYS101',
                'description' => 'Physics with Calculus 1',
                'is_active' => true,
                'department_id' => 1,
            ],
            [
                'id' => 5,
                'name' => 'Physics with Calculus 2',
                'code' => 'PHYS102',
                'description' => 'Physics with Calculus 2',
                'is_active' => true,
                'department_id' => 1,
            ],
            [
                'id' => 6,
                'name' => 'English Communication Skills',
                'code' => 'ENG101',
                'description' => 'Communication Skills in English',
                'is_active' => true,
                'department_id' => 1,
            ],
            [
                'id' => 7,
                'name' => 'English Technical Writing',
                'code' => 'ENG102',
                'description' => 'Technical Writing in English',
                'is_active' => true,
                'department_id' => 1,
            ],
            [
                'id' => 8,
                'name' => 'Filipino Panitikang Pilipino',
                'code' => 'FIL101',
                'description' => 'Filipino Literature and Writing',
                'is_active' => true,
                'department_id' => 1,
            ],
            [
                'id' => 9,
                'name' => 'Filipino Komunikasyon',
                'code' => 'FIL102',
                'description' => 'Filipino Communication Skills',
                'is_active' => true,
                'department_id' => 1,
            ],
            [
                'id' => 10,
                'name' => 'Chemistry General Chemistry',
                'code' => 'CHEM101',
                'description' => 'General Chemistry for Engineering students',
                'is_active' => true,
                'department_id' => 1,
            ],
            [
                'id' => 11,
                'name' => 'Chemistry Organic Chemistry',
                'code' => 'CHEM102',
                'description' => 'Organic Chemistry for Engineering students',
                'is_active' => true,
                'department_id' => 1,
            ],
            [
                'id' => 12,
                'name' => 'Chemistry Physical Chemistry',
                'code' => 'CHEM103',
                'description' => 'Physical Chemistry for Engineering students',
                'is_active' => true,
                'department_id' => 1,
            ],
            [
                'id' => 13,
                'name' => 'Ethics, Rizal\'s Life, and History',
                'code' => 'ETH101',
                'description' => 'Ethics and History of Rizal',
                'is_active' => true,
                'department_id' => 1,
            ],

            // Department 2 - Courses
            [
                'id' => 14,
                'name' => 'Mathematics Algebra',
                'code' => 'MATH201',
                'description' => 'Algebra for IT students',
                'is_active' => true,
                'department_id' => 2,
            ],
            [
                'id' => 15,
                'name' => 'Mathematics Statistics',
                'code' => 'MATH202',
                'description' => 'Statistics for IT students',
                'is_active' => true,
                'department_id' => 2,
            ],
            [
                'id' => 16,
                'name' => 'Mathematics Discrete Math',
                'code' => 'MATH203',
                'description' => 'Discrete Mathematics for IT students',
                'is_active' => true,
                'department_id' => 2,
            ],
            [
                'id' => 17,
                'name' => 'Physics for Computing',
                'code' => 'PHYS201',
                'description' => 'Physics for Computing students',
                'is_active' => true,
                'department_id' => 2,
            ],
            [
                'id' => 18,
                'name' => 'Communication Skills in English 1',
                'code' => 'ENG201',
                'description' => 'English Communication Skills 1',
                'is_active' => true,
                'department_id' => 2,
            ],
            [
                'id' => 19,
                'name' => 'Communication Skills in English 2',
                'code' => 'ENG202',
                'description' => 'English Communication Skills 2',
                'is_active' => true,
                'department_id' => 2,
            ],
            [
                'id' => 20,
                'name' => 'Ethics',
                'code' => 'ETH201',
                'description' => 'Ethics for IT students',
                'is_active' => true,
                'department_id' => 2,
            ],
            [
                'id' => 21,
                'name' => 'Rizal\'s Life',
                'code' => 'ETH202',
                'description' => 'Rizal\'s Life for IT students',
                'is_active' => true,
                'department_id' => 2,
            ],
            [
                'id' => 22,
                'name' => 'Filipino',
                'code' => 'FIL201',
                'description' => 'Filipino for IT students',
                'is_active' => true,
                'department_id' => 2,
            ],

            // Department 3 - Courses
            [
                'id' => 23,
                'name' => 'Anatomy and Physiology',
                'code' => 'NURS101',
                'description' => 'Anatomy and Physiology for Nursing students',
                'is_active' => true,
                'department_id' => 3,
            ],
            [
                'id' => 24,
                'name' => 'English for Academic Purposes',
                'code' => 'ENG301',
                'description' => 'English for Academic Purposes for Nursing students',
                'is_active' => true,
                'department_id' => 3,
            ],
            [
                'id' => 25,
                'name' => 'Filipino for Nursing',
                'code' => 'FIL301',
                'description' => 'Filipino for Nursing students',
                'is_active' => true,
                'department_id' => 3,
            ],
            [
                'id' => 26,
                'name' => 'General Psychology',
                'code' => 'PSYCH101',
                'description' => 'General Psychology for Nursing students',
                'is_active' => true,
                'department_id' => 3,
            ],

            // Department 4 - Courses
            [
                'id' => 27,
                'name' => 'Basic Life Support and CPR',
                'code' => 'HLTH101',
                'description' => 'Basic Life Support and CPR for healthcare professionals',
                'is_active' => true,
                'department_id' => 4,
            ],
            [
                'id' => 28,
                'name' => 'First Aid',
                'code' => 'HLTH102',
                'description' => 'First Aid for healthcare professionals',
                'is_active' => true,
                'department_id' => 4,
            ],
            [
                'id' => 29,
                'name' => 'Providing Care to Infants and Toddlers',
                'code' => 'HLTH103',
                'description' => 'Care for Infants and Toddlers in healthcare',
                'is_active' => true,
                'department_id' => 4,
            ],
            [
                'id' => 30,
                'name' => 'Elderly Care Techniques',
                'code' => 'HLTH104',
                'description' => 'Care for the Elderly in healthcare',
                'is_active' => true,
                'department_id' => 4,
            ],
            [
                'id' => 31,
                'name' => 'Assisting in Ambulatory Care',
                'code' => 'HLTH105',
                'description' => 'Ambulatory Care assistance in healthcare',
                'is_active' => true,
                'department_id' => 4,
            ],
            [
                'id' => 32,
                'name' => 'Housekeeping and Sanitation Practices',
                'code' => 'HLTH106',
                'description' => 'Housekeeping and Sanitation Practices in healthcare',
                'is_active' => true,
                'department_id' => 4,
            ],
            [
                'id' => 33,
                'name' => 'Communication and Interpersonal Skills',
                'code' => 'HLTH107',
                'description' => 'Communication and Interpersonal Skills in healthcare',
                'is_active' => true,
                'department_id' => 4,
            ],
            [
                'id' => 34,
                'name' => 'Emergency Response and Safety',
                'code' => 'HLTH108',
                'description' => 'Emergency Response and Safety in healthcare',
                'is_active' => true,
                'department_id' => 4,
            ],
            [
                'id' => 35,
                'name' => 'Proper Nutrition and Meal Preparation',
                'code' => 'HLTH109',
                'description' => 'Proper Nutrition and Meal Preparation for healthcare professionals',
                'is_active' => true,
                'department_id' => 4,
            ],
            [
                'id' => 36,
                'name' => 'Infection Control',
                'code' => 'HLTH110',
                'description' => 'Infection Control Practices in healthcare',
                'is_active' => true,
                'department_id' => 4,
            ],
        ]);

        // Department 5 - Courses
        Subject::insert([
            [
                'id' => 37,
                'name' => 'Mathematics in the Modern World',
                'code' => 'MATH301',
                'description' => 'Mathematics in the Modern World',
                'is_active' => true,
                'department_id' => 5,
            ],
            [
                'id' => 38,
                'name' => 'Science, Technology, and Society',
                'code' => 'STSS101',
                'description' => 'Science, Technology, and Society for general studies',
                'is_active' => true,
                'department_id' => 5,
            ],
            [
                'id' => 39,
                'name' => 'Understanding the Self',
                'code' => 'GEN101',
                'description' => 'Understanding the Self for general studies',
                'is_active' => true,
                'department_id' => 5,
            ],
            [
                'id' => 40,
                'name' => 'Purposive Communication',
                'code' => 'COM101',
                'description' => 'Purposive Communication for general studies',
                'is_active' => true,
                'department_id' => 5,
            ],
        ]);

        // Department 6 - Courses
        Subject::insert([
            [
                'id' => 41,
                'name' => 'Principles and Methods of Teaching',
                'code' => 'EDUC101',
                'description' => 'Principles and Methods of Teaching for education students',
                'is_active' => true,
                'department_id' => 6,
            ],
            [
                'id' => 42,
                'name' => 'Classroom Management',
                'code' => 'EDUC102',
                'description' => 'Classroom Management for education students',
                'is_active' => true,
                'department_id' => 6,
            ],
            [
                'id' => 43,
                'name' => 'Educational Assessment',
                'code' => 'EDUC103',
                'description' => 'Educational Assessment for education students',
                'is_active' => true,
                'department_id' => 6,
            ],
            [
                'id' => 44,
                'name' => 'Major Specialization English',
                'code' => 'EDUC201',
                'description' => 'Major Specialization English for education students',
                'is_active' => true,
                'department_id' => 6,
            ],
            [
                'id' => 45,
                'name' => 'Major Specialization Math',
                'code' => 'EDUC202',
                'description' => 'Major Specialization Math for education students',
                'is_active' => true,
                'department_id' => 6,
            ],
            [
                'id' => 46,
                'name' => 'Major Specialization Science',
                'code' => 'EDUC203',
                'description' => 'Major Specialization Science for education students',
                'is_active' => true,
                'department_id' => 6,
            ],
            [
                'id' => 47,
                'name' => 'Practice Teaching',
                'code' => 'EDUC204',
                'description' => 'Practice Teaching for education students',
                'is_active' => true,
                'department_id' => 6,
            ],
        ]);

        // Department 7 - Courses
        Subject::insert([
            [
                'id' => 48,
                'name' => 'Mathematics in the Modern World',
                'code' => 'MATH301',
                'description' => 'Mathematics in the Modern World for general studies',
                'is_active' => true,
                'department_id' => 7,
            ],
            [
                'id' => 49,
                'name' => 'Purposive Communication',
                'code' => 'COM101',
                'description' => 'Purposive Communication for general studies',
                'is_active' => true,
                'department_id' => 7,
            ],
        ]);

        // Department 8 - Courses
        Subject::insert([
            [
                'id' => 50,
                'name' => 'Mathematics Business Math',
                'code' => 'MATH401',
                'description' => 'Business Mathematics for business students',
                'is_active' => true,
                'department_id' => 8,
            ],
            [
                'id' => 51,
                'name' => 'Mathematics Statistics Algebra',
                'code' => 'MATH402',
                'description' => 'Statistics Algebra for business students',
                'is_active' => true,
                'department_id' => 8,
            ],
            [
                'id' => 52,
                'name' => 'English Communication Skills',
                'code' => 'ENG101',
                'description' => 'Communication Skills in English for general studies',
                'is_active' => true,
                'department_id' => 8,
            ],
            [
                'id' => 53,
                'name' => 'Science, Technology, and Society',
                'code' => 'STSS101',
                'description' => 'Science, Technology, and Society for general studies',
                'is_active' => true,
                'department_id' => 8,
            ],
            [
                'id' => 54,
                'name' => 'Ethics',
                'code' => 'ETH101',
                'description' => 'Ethics for business and general students',
                'is_active' => true,
                'department_id' => 8,
            ],
            [
                'id' => 55,
                'name' => 'Rizal’s Life',
                'code' => 'PHIL101',
                'description' => 'Life and works of Dr. Jose Rizal',
                'is_active' => true,
                'department_id' => 8,
            ],
        ]);

        // Department 9 - Courses
        Subject::insert([
            [
                'id' => 56,
                'name' => 'Mathematics in the Modern World',
                'code' => 'MATH301',
                'description' => 'Mathematics in the Modern World for general studies',
                'is_active' => true,
                'department_id' => 9,
            ],
            [
                'id' => 57,
                'name' => 'English for Academic Purposes',
                'code' => 'ENG201',
                'description' => 'English for Academic Purposes',
                'is_active' => true,
                'department_id' => 9,
            ],
            [
                'id' => 58,
                'name' => 'Understanding the Self',
                'code' => 'GEN101',
                'description' => 'Understanding the Self for general studies',
                'is_active' => true,
                'department_id' => 9,
            ],
        ]);

        // Department 10 - Courses
        Subject::insert([
            [
                'id' => 59,
                'name' => 'Mathematics (Business Math, Statistics, Algebra)',
                'code' => 'MATH401',
                'description' => 'Business Math, Statistics, Algebra for business students',
                'is_active' => true,
                'department_id' => 10,
            ],
            [
                'id' => 60,
                'name' => 'English Communication Skills',
                'code' => 'ENG101',
                'description' => 'Communication Skills in English for business and general students',
                'is_active' => true,
                'department_id' => 10,
            ],
            [
                'id' => 61,
                'name' => 'Science, Technology, and Society',
                'code' => 'STSS101',
                'description' => 'Science, Technology, and Society for business students',
                'is_active' => true,
                'department_id' => 10,
            ],
            [
                'id' => 62,
                'name' => 'Ethics and Rizal’s Life',
                'code' => 'PHIL101',
                'description' => 'Ethics and Rizal’s Life for business students',
                'is_active' => true,
                'department_id' => 10,
            ],
        ]);

        // Department 11 - Courses
        Subject::insert([
            [
                'id' => 63,
                'name' => 'Mathematics in the Modern World',
                'code' => 'MATH301',
                'description' => 'Mathematics in the Modern World for general studies',
                'is_active' => true,
                'department_id' => 12,
            ],
            [
                'id' => 64,
                'name' => 'English for Academic Purposes',
                'code' => 'ENG201',
                'description' => 'English for Academic Purposes for general students',
                'is_active' => true,
                'department_id' => 12,
            ],
            [
                'id' => 65,
                'name' => 'Understanding the Self',
                'code' => 'GEN101',
                'description' => 'Understanding the Self for general studies',
                'is_active' => true,
                'department_id' => 12,
            ],
            [
                'id' => 66,
                'name' => 'Mathematics Statistics',
                'code' => 'MATH402',
                'description' => 'Mathematics Statistics for general students',
                'is_active' => true,
                'department_id' => 12,
            ],
            [
                'id' => 67,
                'name' => 'Mathematics Algebra',
                'code' => 'MATH403',
                'description' => 'Mathematics Algebra for general students',
                'is_active' => true,
                'department_id' => 12,
            ],
            [
                'id' => 68,
                'name' => 'Purposive Communication',
                'code' => 'COM101',
                'description' => 'Purposive Communication for general studies',
                'is_active' => true,
                'department_id' => 12,
            ],
            [
                'id' => 69,
                'name' => 'Ethics and Filipino Subjects',
                'code' => 'ETH101',
                'description' => 'Ethics and Filipino Subjects for general students',
                'is_active' => true,
                'department_id' => 12,
            ],
        ]);

        // Department 12 - Courses
        Subject::insert([
            [
                'id' => 70,
                'name' => 'Mathematics in the Modern World',
                'code' => 'MATH301',
                'description' => 'Mathematics in the Modern World for general studies',
                'is_active' => true,
                'department_id' => 13,
            ],
            [
                'id' => 71,
                'name' => 'English for Professional Purposes',
                'code' => 'ENG301',
                'description' => 'English for Professional Purposes for general studies',
                'is_active' => true,
                'department_id' => 13,
            ],

        ]);
    }
}
