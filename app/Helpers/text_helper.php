<?php

if (!function_exists('truncateText')) {
    function truncateText($text, $limit = 178, $ellipsis = '...') {
        // Remove as tags HTML
        $text = strip_tags($text);
        
        // Verifica se o texto já é menor que o limite
        if (mb_strlen($text) <= $limit) {
            return $text;
        }
        
        // Trunca o texto sem cortar palavras no meio
        $truncated = mb_substr($text, 0, $limit);
        $lastSpace = mb_strrpos($truncated, ' ');
        
        if ($lastSpace !== false) {
            $truncated = mb_substr($truncated, 0, $lastSpace);
        }
        
        // Adiciona o ellipsis
        return $truncated . $ellipsis;
    }
}

if (!function_exists('generateSlug')) {
    function generateSlug($text) {
        // Converte para minúsculas
        $text = mb_strtolower($text, 'UTF-8');
        
        // Remove acentos e caracteres especiais
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
        
        // Remove caracteres não alfanuméricos
        $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
        
        // Substitui espaços por hífens
        $text = preg_replace('/\s+/', '-', $text);
        
        // Remove hífens duplicados
        $text = preg_replace('/-+/', '-', $text);
        
        // Remove hífens no início e no final
        $text = trim($text, '-');
        
        return $text;
    }
}

