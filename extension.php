<?php

class HtmlWrapperExtension extends Minz_Extension
{

    public function init()
    {
        $this->registerHook('entry_before_display', array($this, 'wrap'));
    }

    public function wrap($entry)
    {
        $domain = $this->get_domain_name($entry->link());
        $category = $this->get_category_wrapper_name($entry);

        $entry->_content("<div class=\"$domain $category\">" . $entry->content() . "</div>");

        return $entry;
    }

    private function get_domain_name($url)
    {
        // Remove the protocol and path from the URL
        $url = preg_replace('#^(https?://)?(www\.)?([^/]+)(/.*)?$#', '$3', $url);

        // Replace dots with underscores
        return str_replace('.', '_', $url);
    }

    private function get_category_wrapper_name($entry)
    {
        $category = $entry->feed()->category();
        $name = str_replace(' ', '_', $category->name());
        $id = $category->id();

        return 'c_' . strtolower($name) . ' c_id_' . $id;
    }
}
