<?php

namespace Helpers;

use Faker\Factory;
use Models\User;
use Models\Company;
use Models\Employee;
use Models\RestaurantChain;
use Models\RestaurantLocation;

class RandomGenerator
{
    public static function user(): User
    {
        $faker = Factory::create();

        return new User(
            $faker->randomNumber(),
            $faker->firstName(),
            $faker->lastName(),
            $faker->email,
            $faker->password,
            $faker->phoneNumber,
            $faker->address,
            $faker->dateTimeThisCentury,
            $faker->dateTimeBetween('-10 years', '+20 years'),
            $faker->randomElement(['admin', 'user', 'editor']),
            true
        );
    }

    public static function users(int $min, int $max): array
    {
        $faker = Factory::create();
        $users = [];
        $numOfUsers = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfUsers; $i++) {
            $users[] = self::user();
        }

        return $users;
    }
    public static function employee(int $minSalary,
    int $maxSalary): Employee
    {
        $faker = Factory::create();



        // 賞のリストを生成
        $awardListRandom = [];
        $numberOfAwards = $faker->numberBetween(1, 5); // 生成する賞の数をランダムに決定（例: 1 から 5 の間）

        for ($i = 0; $i < $numberOfAwards; $i++) {
            $awardListRandom[] = $faker->word; // 単語を賞としてリストに追加
        }
        return new Employee(
            $faker->randomNumber(), //int $id
            $faker->firstName(), //string $firstName
            $faker->lastName(), //string $lastName
            $faker->email, //string $email
            $faker->password, //string $password
            $faker->phoneNumber, //tring $phoneNumber
            $faker->address, //string $address
            $faker->dateTimeThisCentury, //DateTime $birthDate
            $faker->dateTimeBetween('-10 years', '+20 years'), //DateTime $membershipExpirationDate
            $faker->randomElement(['admin', 'user', 'editor']), //string $role
            $faker->randomElement(['manager', 'chief', 'staff']), //string $position
            $faker->randomFloat(2, $minSalary, $maxSalary), //float $salary
            $faker->dateTimeBetween('-3 years', 'now'), //DateTime $startDate
            $awardListRandom,

        );
    }

    public static function employees(int $min, int $max,int $minSalary,
    int $maxSalary): array
    {
        $faker = Factory::create();
        $employees = [];
        $numOfEmployees = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfEmployees; $i++) {
            $employees[] = self::employee($minSalary,$maxSalary);
        }

        return $employees;
    }

    public static function company(): Company
    {
        $faker = Factory::create();



        $randomDate = $faker->dateTimeBetween('1980-01-01', '2022-12-31');
        $randomYear = $randomDate->format('Y'); // 年のみを取得

        return new Company(
            $faker->company."'s company",
            $randomYear,
            $faker->text(200),
            $faker->url,
            $faker->phoneNumber,
            $faker->bs,
            $faker->firstName() . $faker->lastName(),
            $faker->boolean,
            $faker->country,
            $faker->firstName() . $faker->lastName(),
            $faker->randomNumber(),
        );
    }


    public static function location(int $minZip, int $maxZip,
    int $employeeCount, int $minSalary,
    int $maxSalary): RestaurantLocation
    {
        $faker = Factory::create();

        $employees = self::employees($employeeCount, $employeeCount,$minSalary,$maxSalary);
        return new RestaurantLocation(
            $faker->word(20),
            $faker->address,
            $faker->city,
            $faker->state,
            (string)rand($minZip, $maxZip),
            $employees,
            $faker->boolean,
            $faker->boolean,

        );
    }

    public static function restaurantLocations(int $min, int $max,int $minZip, int $maxZip,
    int $employeeCount, int $minSalary,
    int $maxSalary): array
    {
        $faker = Factory::create();
        $locations = [];
        $numOfLocations = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfLocations; $i++) {
            $locations[] = self::location($minZip,$maxZip,
            $employeeCount, $minSalary,
            $maxSalary);
        }

        return $locations;
    }


    public static function companies(int $min, int $max): array
    {
        $faker = Factory::create();
        $companies = [];
        $numOfUsers = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfUsers; $i++) {
            $companies[] = self::company();
        }

        return $companies;
    }



    public static function restaurantChain(Company $parentCompany, int $locationCount,
    int $minZip, int $maxZip,
    int $employeeCount, int $minSalary,
    int $maxSalary): RestaurantChain
    {
        $faker = Factory::create();

        $randomDate = $faker->dateTimeBetween('1980-01-01', '2022-12-31');
        $randomYear = $randomDate->format('Y'); // 年のみを取得


        $parentCompanyInfo = $parentCompany->toArray();


        // レストランチェーンの設立年を生成
        $foundingYear = $faker->numberBetween($parentCompanyInfo["foundingYear"], 2022);

        //チェーン店のロケーションを作成
        $locations = self::restaurantLocations($locationCount, $locationCount,$minZip, $maxZip,
        $employeeCount,  $minSalary,
     $maxSalary);




        return new RestaurantChain(
            $parentCompany, //Company $parentCompany,
            $faker->randomNumber(), //int $chainID,
            $locations, //array $restaurantLocations,
            $faker->randomElement(['Chinese', 'French', 'Italian', 'Japanese', 'Turkish']), //string $cuisineType
            count($locations), //int $numberOfLocations
            $faker->boolean, // int  $isDriveThrough
            $foundingYear, //int  $chainFoundingYear


        );
    }


    public static function restaurantChains(int $chainCount, int $locationCount,
    int $minZip, int $maxZip,
    int $employeeCount, int $minSalary,
    int $maxSalary
    ): array
    {
        $faker = Factory::create();
        $chains = [];

        
        
        // $numOfChains = $faker->numberBetween($min, $max);
        
        for ($i = 0; $i < $chainCount; $i++) {
            $company = self::company();//会社の生成
            $chains[] = self::restaurantChain($company, $locationCount,
            $minZip,  $maxZip,
            $employeeCount,  $minSalary,
            $maxSalary);//チェーンの生成
        }

        return $chains;
    }
}
