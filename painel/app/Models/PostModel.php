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
        'deleted_at' // Adicione esta linha
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'content' => 'required',
        'author_name' => 'required|min_length[3]|max_length[100]'
    ];
    
    protected $validationMessages = [
        'title' => [
            'required' => 'O título é obrigatório',
            'min_length' => 'O título deve ter no mínimo 3 caracteres',
            'max_length' => 'O título deve ter no máximo 255 caracteres'
        ],
        'content' => [
            'required' => 'O conteúdo é obrigatório'
        ],
        'cover_type' => [
            'required' => 'O tipo de capa é obrigatório',
            'in_list' => 'O tipo de capa deve ser image ou video'
        ],
        'author_name' => [
            'required' => 'O nome do autor é obrigatório',
            'min_length' => 'O nome do autor deve ter no mínimo 3 caracteres',
            'max_length' => 'O nome do autor deve ter no máximo 100 caracteres'
        ]
    ];

    protected $skipValidation = false;
}