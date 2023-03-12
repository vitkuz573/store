<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Validation\Factory as ValidatorFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * The name of the admin role.
     */
    private const ADMIN_ROLE_NAME = 'admin';

    /**
     * The minimum length of a user's password.
     */
    private const MIN_PASSWORD_LENGTH = 8;

    /**
     * The validator factory instance.
     *
     * @var ValidatorFactory
     */
    private ValidatorFactory $validator;

    /**
     * The admin user's name.
     *
     * @var string
     */
    private string $adminName;

    /**
     * The admin user's email.
     *
     * @var string
     */
    private string $adminEmail;

    /**
     * The admin user's password.
     *
     * @var string
     */
    private string $adminPassword;

    /**
     * Whether to seed the admin user or not.
     *
     * @var bool
     */
    private bool $seedAdmin;

    /**
     * Create a new seeder instance.
     *
     * @param ValidatorFactory $validator The validator factory instance.
     * @param bool $seedAdmin Whether to seed the admin user or not.
     * @param string|null $adminName The admin user's name. Defaults to "Admin".
     * @param string|null $adminEmail The admin user's email. Defaults to "admin@example.com".
     * @param string|null $adminPassword The admin user's password.
     */
    public function __construct(
        ValidatorFactory $validator,
        bool             $seedAdmin = true,
        ?string          $adminName = null,
        ?string          $adminEmail = null,
        ?string          $adminPassword = null
    )
    {
        $this->validator = $validator;
        $this->adminName = $adminName ?? config('seeds.admin.name', 'Admin');
        $this->adminEmail = $adminEmail ?? config('seeds.admin.email', 'admin@example.com');
        $this->adminPassword = $adminPassword ?? config('seeds.admin.password');
        $this->seedAdmin = $seedAdmin;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (!$this->seedAdmin) {
            $this->command->info('Admin user seeding disabled.');

            return;
        }

        $validator = $this->validator->make([
            'name' => $this->adminName,
            'email' => $this->adminEmail,
            'password' => $this->adminPassword,
        ], $this->getValidationRules());

        if ($validator->fails()) {
            $this->command->error('Failed to seed admin user:');
            $this->command->error(implode("\n", $validator->errors()->all()));

            return;
        }

        $adminRole = Role::whereName(self::ADMIN_ROLE_NAME)->first();

        if (!$adminRole) {
            $this->command->error('Failed to seed admin user: admin role not found.');

            return;
        }

        $user = $this->createAdminUser();
        $user->roles()->attach($adminRole);

        $this->command->info('Admin user seeded successfully.');
        $this->command->info(sprintf('Email: %s', $this->adminEmail));
        $this->command->info(sprintf('Password: %s', $this->adminPassword));
    }

    /**
     *
     * Get the validation rules for the admin user.
     *
     * @return array
     */
    private function getValidationRules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => "required|string|min:" . self::MIN_PASSWORD_LENGTH,
        ];
    }

    /**
     * Create a new admin user instance.
     *
     * @return User
     */
    private function createAdminUser(): User
    {
        return User::factory()->create([
            'name' => $this->adminName,
            'email' => $this->adminEmail,
            'password' => Hash::make($this->adminPassword),
        ]);
    }
}
