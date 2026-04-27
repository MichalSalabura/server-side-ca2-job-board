<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobListing;
use App\Models\User;
use App\Models\EmployerProfile;
use Illuminate\Support\Facades\Hash;

class JobListingSeeder extends Seeder
{
    public function run(): void
    {
        // Create a demo employer if none exists
        $employer = User::firstOrCreate(
            ['email' => 'demo@techhire.com'],
            [
                'name' => 'Demo Employer',
                'password' => Hash::make('password'),
                'role' => 'employer',
            ]
        );

        if (!$employer->employerProfile) {
            EmployerProfile::create([
                'user_id' => $employer->id,
                'company_name' => 'TechHire Demo',
                'description' => 'Demo company',
                'location' => 'Dublin',
                'website' => 'https://techhire.com',
            ]);
        }

        $jobs = [
            [
                'title' => 'Frontend Developer',
                'company_name' => 'Google Ireland',
                'description' => 'We are looking for a skilled Frontend Developer to join our Dublin team. You will work on cutting-edge web applications using React and modern JavaScript.',
                'location' => 'Dublin',
                'latitude' => 53.3498,
                'longitude' => -6.2603,
                'salary' => '€55,000 - €75,000',
                'type' => 'full-time',
                'status' => 'open',
            ],
            [
                'title' => 'Backend Engineer',
                'company_name' => 'Stripe',
                'description' => 'Join Stripe\'s engineering team in Dublin. Work on scalable payment infrastructure used by millions of businesses worldwide.',
                'location' => 'Dublin',
                'latitude' => 53.3498,
                'longitude' => -6.2603,
                'salary' => '€65,000 - €90,000',
                'type' => 'full-time',
                'status' => 'open',
            ],
            [
                'title' => 'UX Designer',
                'company_name' => 'Shopify',
                'description' => 'Design intuitive user experiences for our e-commerce platform. Work closely with product and engineering teams.',
                'location' => 'Cork',
                'latitude' => 51.8985,
                'longitude' => -8.4756,
                'salary' => '€45,000 - €60,000',
                'type' => 'full-time',
                'status' => 'open',
            ],
            [
                'title' => 'DevOps Engineer',
                'company_name' => 'Amazon Web Services',
                'description' => 'Manage and scale cloud infrastructure for AWS customers. Experience with Kubernetes and Terraform required.',
                'location' => 'Dublin',
                'latitude' => 53.3498,
                'longitude' => -6.2603,
                'salary' => '€70,000 - €95,000',
                'type' => 'full-time',
                'status' => 'open',
            ],
            [
                'title' => 'Data Analyst',
                'company_name' => 'Accenture',
                'description' => 'Analyse large datasets to provide business insights. Strong SQL and Python skills required.',
                'location' => 'Galway',
                'latitude' => 53.2707,
                'longitude' => -9.0568,
                'salary' => '€40,000 - €55,000',
                'type' => 'full-time',
                'status' => 'open',
            ],
            [
                'title' => 'Mobile Developer',
                'company_name' => 'Workday',
                'description' => 'Build cross-platform mobile apps using Flutter. You will work on HR and finance applications used globally.',
                'location' => 'Kilkenny',
                'latitude' => 52.6541,
                'longitude' => -7.2448,
                'salary' => '€50,000 - €70,000',
                'type' => 'full-time',
                'status' => 'open',
            ],
            [
                'title' => 'PHP Developer',
                'company_name' => 'Intercom',
                'description' => 'Work on our customer messaging platform backend. Laravel experience is a plus.',
                'location' => 'Dublin',
                'latitude' => 53.3498,
                'longitude' => -6.2603,
                'salary' => '€50,000 - €65,000',
                'type' => 'contract',
                'status' => 'open',
            ],
            [
                'title' => 'Junior Software Engineer',
                'company_name' => 'Intel',
                'description' => 'Entry level position for recent graduates. Work on internal systems and student-facing applications.',
                'location' => 'Dublin',
                'latitude' => 54.0028,
                'longitude' => -6.4052,
                'salary' => '€30,000 - €40,000',
                'type' => 'full-time',
                'status' => 'open',
            ],
            [
                'title' => 'QA Engineer',
                'company_name' => 'Revolut',
                'description' => 'Ensure software quality through manual and automated testing. Selenium experience preferred.',
                'location' => 'Limerick',
                'latitude' => 52.6638,
                'longitude' => -8.6267,
                'salary' => '€40,000 - €55,000',
                'type' => 'full-time',
                'status' => 'open',
            ],
            [
                'title' => 'Cybersecurity Analyst',
                'company_name' => 'Mastercard',
                'description' => 'Protect our payment systems from cyber threats. Experience with penetration testing and SIEM tools required.',
                'location' => 'Dublin',
                'latitude' => 53.3498,
                'longitude' => -6.2603,
                'salary' => '€60,000 - €80,000',
                'type' => 'full-time',
                'status' => 'open',
            ],
        ];

        foreach ($jobs as $job) {
            JobListing::create(array_merge($job, ['user_id' => $employer->id]));
        }
    }
}