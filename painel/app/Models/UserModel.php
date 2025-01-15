<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true; // Habilita soft delete
    protected $allowedFields = [
        'name',
        'email',
        'password',
        'role',
        'deleted_at'
    ];
    protected $useTimestamps = true; // Habilita created_at e updated_at
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at'; // Campo usado para soft delete

    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }

}
