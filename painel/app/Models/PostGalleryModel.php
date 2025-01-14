<?php

namespace App\Models;

use CodeIgniter\Model;

class PostGalleryModel extends Model
{
    protected $table = 'post_gallery';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    
    protected $allowedFields = [
        'post_id',
        'image_name'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'post_id' => 'required|numeric|is_not_unique[posts.id]',
        'image_name' => 'required|max_length[255]'
    ];
    
    protected $validationMessages = [
        'post_id' => [
            'required' => 'O ID do post é obrigatório',
            'numeric' => 'O ID do post deve ser um número',
            'is_not_unique' => 'O post informado não existe'
        ],
        'image_name' => [
            'required' => 'O nome da imagem é obrigatório',
            'max_length' => 'O nome da imagem deve ter no máximo 255 caracteres'
        ]
    ];

    protected $skipValidation = false;
}
