<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            CompanySeeder::class,
            UserSeeder::class,
            SecteurSeeder::class,
            StypeSeeder::class,
            OtypeSeeder::class,
            OrganismeSeeder::class,
            ProductSeeder::class,
            discountSeeder::class,
            ConsultationTypeSeeder::class,
            ConsultationSeeder::class,
            ConsultationSecteurSeeder::class,
            ClasseSeeder::class,
            QualificationSeeder::class,
            AgreementSeeder::class,
            RegionVilleSeeder::class,

        ]);
    }
}
