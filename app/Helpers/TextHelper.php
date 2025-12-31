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

        // Preserve code blocks - extract them first
        $codeBlocks = [];
        $codeBlockIndex = 0;
        
        // Extract <pre><code> blocks
        $text = preg_replace_callback('/<pre>(.*?)<\/pre>/s', function($matches) use (&$codeBlocks, &$codeBlockIndex) {
            $placeholder = "___CODE_BLOCK_{$codeBlockIndex}___";
            $codeBlocks[$placeholder] = $matches[0];
            $codeBlockIndex++;
            return $placeholder;
        }, $text);
        
        // Also extract standalone <code> tags
        $text = preg_replace_callback('/<code>(.*?)<\/code>/s', function($matches) use (&$codeBlocks, &$codeBlockIndex) {
            $placeholder = "___CODE_BLOCK_{$codeBlockIndex}___";
            $codeBlocks[$placeholder] = $matches[0];
            $codeBlockIndex++;
            return $placeholder;
        }, $text);

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
                // Check if this paragraph is a code block placeholder
                if (preg_match('/___CODE_BLOCK_\d+___/', $paragraph)) {
                    // Don't process code blocks, just add them as is
                    $formatted[] = $paragraph;
                    continue;
                }
                
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

        $result = implode('', $formatted);
        
        // Restore code blocks
        foreach ($codeBlocks as $placeholder => $codeBlock) {
            $result = str_replace($placeholder, $codeBlock, $result);
        }
        
        return $result;
    }
}
