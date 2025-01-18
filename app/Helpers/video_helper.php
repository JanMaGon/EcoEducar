<?php

if (!function_exists('getYouTubeVideoId')) {
    function getYouTubeVideoId($url) {
        $regExp = '/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/';
        preg_match($regExp, $url, $match);
        return (isset($match[2]) && strlen($match[2]) === 11) ? $match[2] : null;
    }
}

if (!function_exists('getVimeoVideoId')) {
    function getVimeoVideoId($url) {
        $regExp = '/^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/';
        preg_match($regExp, $url, $match);
        return isset($match[5]) ? $match[5] : null;
    }
}

if (!function_exists('generateVideoEmbedCode')) {
    function generateVideoEmbedCode($url, $height) {
        if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
            $videoId = getYouTubeVideoId($url);
            if ($videoId) {
                return '<iframe width="100%" height="'.$height.'" src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
            }
        } elseif (strpos($url, 'vimeo.com') !== false) {
            $videoId = getVimeoVideoId($url);
            if ($videoId) {
                return '<iframe src="https://player.vimeo.com/video/' . $videoId . '" width="100%" height="'.$height.'" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>';
            }
        }
        return null;
    }
}
