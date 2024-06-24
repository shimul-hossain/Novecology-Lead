<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            // LeadSeeder::class,
            // DefaultHeaderFilterSeeder::class,
            // ClientSeeder::class,
            // NavigationSeeder::class, 
            // NonNavigationSeeder::class,
            // UserSeeder::class,
            // ZoneSeeder::class,
            // ZoneInfoSeeder::class,
            // CheckZoneSeeder::class,
            // OutsideFranceSeeder::class,
            // InsideFranceSeeder::class,
            // TagSeeder::class,
            // ProjectHeaderSeeder::class,
            // TokenSeeder::class,
            // ProjectStatusSeeder::class,
            // SavSeeder::class, 
            // ProjectTabSeeder::class, 
            // FaviconSeeder::class, 
            // AdminSeeder::class,
            // CommentCategorySeeder::class,
            // RoleCategorySeeder::class,
            // RoleSeeder::class,
            // DocumentControlSeeder::class,
            // LeadStatusSeeder::class,
            // StatusPlanningInterventionSeeder::class,
            // StatutMaprimerenovSeeder::class, 


        // New Backoffice Seeder 
            // NewBannerSeeder::class,
            // ServiceFeatureSeeder::class,
            // OfferCategorySeeder::class,
            // OfferSeeder::class,
            // SupportSeeder::class,
            // SupportInfoSeeder::class,
            // RenovationSeeder::class,
            // RenovationInfoSeeder::class,
            // TestimonialSeeder::class,
            // NewsSeeder::class,
            // AuditEnergetiqueSeeder::class,
            // HistorySeeder::class,
            // ValueSeeder::class,
            // ReferenceSeeder::class,
            // ContactSeeder::class,
            // GeneralSettingSeeder::class,
            // DroitOppositionSeeder::class,
            // CookiePolicySeeder::class,
            // LegalNoticeSeeder::class,
            // PrivacyPolicySeeder::class,
            
        ]);
    }
}
