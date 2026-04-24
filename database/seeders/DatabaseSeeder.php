<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Core Staff Accounts
        User::create(['name' => 'Kato Admin', 'email' => 'admin@citycare.com', 'password' => Hash::make('password'), 'role' => 'admin']);
        User::create(['name' => 'Nalongo Reception', 'email' => 'reception@citycare.com', 'password' => Hash::make('password'), 'role' => 'receptionist']);
        User::create(['name' => 'Ssentongo Cashier', 'email' => 'cashier@citycare.com', 'password' => Hash::make('password'), 'role' => 'cashier']);

        // 2. Create Departments
        $cardio = Department::create(['name' => 'Cardiology', 'description' => 'Heart and cardiovascular diseases']);
        $peds = Department::create(['name' => 'Pediatrics', 'description' => 'Infant, child, and adolescent care']);
        $neuro = Department::create(['name' => 'Neurology', 'description' => 'Brain and nervous system disorders']);
        $ortho = Department::create(['name' => 'Orthopedics', 'description' => 'Bone and joint care']);
        $dental = Department::create(['name' => 'Dental Clinic', 'description' => 'Oral health and surgery']);

        // 3. Create Doctors (Ugandan Names)
        $doctorsData = [
            ['name' => 'Dr. Emmanuel Mukasa', 'email' => 'doctor@citycare.com', 'dept' => $cardio->id, 'spec' => 'Senior Cardiologist', 'phone' => '0772123456'], // Main test doctor
            ['name' => 'Dr. Sarah Nabirye', 'email' => 's.nabirye@citycare.com', 'dept' => $peds->id, 'spec' => 'Pediatrician', 'phone' => '0752987654'],
            ['name' => 'Dr. Joseph Kigozi', 'email' => 'j.kigozi@citycare.com', 'dept' => $neuro->id, 'spec' => 'Neurologist', 'phone' => '0782345678'],
            ['name' => 'Dr. Grace Kemigisha', 'email' => 'g.kemigisha@citycare.com', 'dept' => $ortho->id, 'spec' => 'Orthopedic Surgeon', 'phone' => '0703456789'],
            ['name' => 'Dr. Ali Ssekandi', 'email' => 'a.ssekandi@citycare.com', 'dept' => $dental->id, 'spec' => 'Dentist', 'phone' => '0714567890'],
        ];

        $doctorModels = [];
        foreach ($doctorsData as $data) {
            $user = User::create(['name' => $data['name'], 'email' => $data['email'], 'password' => Hash::make('password'), 'role' => 'doctor']);
            $doctorModels[] = Doctor::create([
                'user_id' => $user->id,
                'department_id' => $data['dept'],
                'specialization' => $data['spec'],
                'phone' => $data['phone'],
                'bio' => 'Experienced specialist dedicated to providing quality healthcare at CityCare Medical Centre.',
            ]);
        }

        // 4. Create Patients (Ugandan Names)
        $patientsData = [
            ['fname' => 'Namagembe', 'lname' => 'Sarah', 'email' => 'patient@citycare.com', 'dob' => '1990-05-14', 'gender' => 'Female', 'phone' => '0701123456', 'address' => 'Ntinda, Kampala'], // Main test patient
            ['fname' => 'Kizito', 'lname' => 'Moses', 'email' => 'm.kizito@gmail.com', 'dob' => '1985-08-22', 'gender' => 'Male', 'phone' => '0773223344', 'address' => 'Makindye, Kampala'],
            ['fname' => 'Akello', 'lname' => 'Mary', 'email' => 'akello.m@yahoo.com', 'dob' => '1995-11-03', 'gender' => 'Female', 'phone' => '0754556677', 'address' => 'Kira, Wakiso'],
            ['fname' => 'Opolot', 'lname' => 'James', 'email' => 'opolotj@hotmail.com', 'dob' => '1978-02-19', 'gender' => 'Male', 'phone' => '0785667788', 'address' => 'Entebbe, Wakiso'],
            ['fname' => 'Namatovu', 'lname' => 'Betty', 'email' => 'bettyn@gmail.com', 'dob' => '2001-09-30', 'gender' => 'Female', 'phone' => '0706778899', 'address' => 'Bweyogerere, Wakiso'],
            ['fname' => 'Tumusiime', 'lname' => 'John', 'email' => 'jtumusiime@yahoo.com', 'dob' => '1982-12-12', 'gender' => 'Male', 'phone' => '0777889900', 'address' => 'Muyenga, Kampala'],
            ['fname' => 'Babirye', 'lname' => 'Joan', 'email' => 'babiryej@gmail.com', 'dob' => '1998-04-25', 'gender' => 'Female', 'phone' => '0758990011', 'address' => 'Rubaga, Kampala'],
            ['fname' => 'Mugisha', 'lname' => 'Arthur', 'email' => 'amugisha@hotmail.com', 'dob' => '1975-07-08', 'gender' => 'Male', 'phone' => '0789001122', 'address' => 'Kololo, Kampala'],
        ];

        $patientModels = [];
        foreach ($patientsData as $data) {
            $user = User::create(['name' => $data['fname'] . ' ' . $data['lname'], 'email' => $data['email'], 'password' => Hash::make('password'), 'role' => 'patient']);
            $patientModels[] = Patient::create([
                'user_id' => $user->id,
                'first_name' => $data['fname'],
                'last_name' => $data['lname'],
                'date_of_birth' => $data['dob'],
                'gender' => $data['gender'],
                'phone' => $data['phone'],
                'address' => $data['address'],
            ]);
        }

        // 5. Create Appointments & Payments
        // Generate realistic dates: Some in the past (completed), some today, some in the future
        $today = Carbon::today();
        
        $appointmentScenarios = [
            // Past Completed Appointments
            ['patient' => 0, 'doctor' => 0, 'date' => $today->copy()->subDays(5)->format('Y-m-d'), 'time' => '09:00', 'status' => 'completed', 'paid' => true, 'amount' => 50000, 'method' => 'Mobile Money'],
            ['patient' => 1, 'doctor' => 1, 'date' => $today->copy()->subDays(3)->format('Y-m-d'), 'time' => '10:30', 'status' => 'completed', 'paid' => true, 'amount' => 60000, 'method' => 'Cash'],
            ['patient' => 2, 'doctor' => 2, 'date' => $today->copy()->subDays(1)->format('Y-m-d'), 'time' => '14:00', 'status' => 'completed', 'paid' => true, 'amount' => 80000, 'method' => 'Card'],
            ['patient' => 3, 'doctor' => 3, 'date' => $today->copy()->subDays(2)->format('Y-m-d'), 'time' => '11:00', 'status' => 'completed', 'paid' => true, 'amount' => 100000, 'method' => 'Insurance'],
            
            // Today's Appointments (Mixed status)
            ['patient' => 4, 'doctor' => 0, 'date' => $today->format('Y-m-d'), 'time' => '09:30', 'status' => 'confirmed', 'paid' => true, 'amount' => 50000, 'method' => 'Mobile Money'],
            ['patient' => 5, 'doctor' => 1, 'date' => $today->format('Y-m-d'), 'time' => '11:30', 'status' => 'pending', 'paid' => false],
            ['patient' => 6, 'doctor' => 2, 'date' => $today->format('Y-m-d'), 'time' => '15:00', 'status' => 'confirmed', 'paid' => false],
            ['patient' => 7, 'doctor' => 4, 'date' => $today->format('Y-m-d'), 'time' => '16:30', 'status' => 'cancelled', 'paid' => false],
            
            // Future Appointments
            ['patient' => 0, 'doctor' => 2, 'date' => $today->copy()->addDays(2)->format('Y-m-d'), 'time' => '10:00', 'status' => 'confirmed', 'paid' => true, 'amount' => 80000, 'method' => 'Mobile Money'],
            ['patient' => 1, 'doctor' => 3, 'date' => $today->copy()->addDays(3)->format('Y-m-d'), 'time' => '12:00', 'status' => 'pending', 'paid' => false],
            ['patient' => 2, 'doctor' => 4, 'date' => $today->copy()->addDays(5)->format('Y-m-d'), 'time' => '09:00', 'status' => 'confirmed', 'paid' => false],
            ['patient' => 3, 'doctor' => 0, 'date' => $today->copy()->addDays(7)->format('Y-m-d'), 'time' => '14:30', 'status' => 'pending', 'paid' => false],
        ];

        foreach ($appointmentScenarios as $scenario) {
            $apt = Appointment::create([
                'patient_id' => $patientModels[$scenario['patient']]->id,
                'doctor_id' => $doctorModels[$scenario['doctor']]->id,
                'appointment_date' => $scenario['date'],
                'appointment_time' => $scenario['time'],
                'status' => $scenario['status'],
                'notes' => 'General checkup and consultation.',
            ]);

            // Create payment if applicable
            if ($scenario['paid']) {
                Payment::create([
                    'patient_id' => $patientModels[$scenario['patient']]->id,
                    'appointment_id' => $apt->id,
                    'amount' => $scenario['amount'],
                    'payment_method' => $scenario['method'],
                    'payment_date' => $scenario['date'],
                    'status' => 'completed',
                ]);
            }
        }
    }
}
