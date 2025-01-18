<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = [
        'user_id',
        'title',
        'content',
        'cover_type',
        'cover_content',
        'author_name',
        'created_at', 
        'updated_at',
        'deleted_at' 
    ];

    
}