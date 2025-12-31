<?php

if (! function_exists('auto_format_text')) {
    function auto_format_text($text)
    {
        if (empty($text)) {
            return '';
        }

        // Clean up the text
        $text = trim($text);

        // Handle different types of line breaks
        $text = str_replace(["\r\n", "\r"], "\n", $text);

        // Split by double line breaks - try multiple approaches
        $paragraphs = [];

        // First try: split by \n\n
        if (strpos($text, "\n\n") !== false) {
            $paragraphs = explode("\n\n", $text);
        } else {
            // Fallback: treat as single paragraph
            $paragraphs = [$text];
        }

        $formatted = [];

        foreach ($paragraphs as $paragraph) {
            $paragraph = trim($paragraph);
            if (! empty($paragraph)) {
                // Replace single line breaks with spaces
                $paragraph = str_replace("\n", ' ', $paragraph);

                // Clean up multiple spaces
                $paragraph = preg_replace('/\s+/', ' ', $paragraph);

                // Capitalize first letter
                $paragraph = ucfirst($paragraph);

                // Capitalize after periods
                $paragraph = preg_replace_callback('/\. (\w)/', function ($matches) {
                    return '. '.ucfirst($matches[1]);
                }, $paragraph);

                $formatted[] = '<p class="mb-4">'.$paragraph.'</p>';
            }
        }

        return implode('', $formatted);
    }
}
