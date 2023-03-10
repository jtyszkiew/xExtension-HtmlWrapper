<?php

class HtmlWrapperExtension extends Minz_Extension
{

    const CATEGORY_PREFIX = 'c_';
    const CATEGORY_ID_PREFIX = 'c_id_';
    const HTML_WRAPPER_CLASS = 'x_html_wrapper';

    public function init()
    {
        $this->registerHook('entry_before_display', array($this, 'wrap'));
    }

    public function wrap($entry)
    {
        $classes = $this->getWrapperClasses($entry);

        $entry->_content("<div class=\"$classes\">" . $entry->content() . "</div>");

        return $entry;
    }

    private function getDomainName($url)
    {
        // Remove the protocol and path from the URL
        $url = preg_replace('#^(https?://)?(www\.)?([^/]+)(/.*)?$#', '$3', $url);

        // Replace dots with underscores
        return str_replace('.', '_', $url);
    }

    private function getWrapperClasses($entry)
    {
        $category = $entry->feed()->category();
        $classes = [
            $this->getDomainName($entry->link()),
            $this->getCategoryClass($this->getFormattedCategoryName($category->name())),
            $this->getCategoryIdClass($category->id()),
            self::HTML_WRAPPER_CLASS
        ];

        return join(' ', $classes);
    }

    private function getCategoryClass($name) {
        return self::CATEGORY_PREFIX . strtolower($name);
    }

    private function getCategoryIdClass($id) {
        return self::CATEGORY_ID_PREFIX . $id;
    }

    private function getFormattedCategoryName($name) {
        return strtolower(str_replace(' ', '_', $name));
    }
}
