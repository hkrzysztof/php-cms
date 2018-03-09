<?php

class Pagination{

    public $current_page, $items_per_page, $items_count;

    public function __construct($current_page = 1, $items_per_page = 4, $items_count = 0) {
        $this->current_page = (int)$current_page;
        $this->items_per_page = (int)$items_per_page;
        $this->items_count = (int)$items_count;
    }

    public function next() {
        return $this->current_page + 1;
    }

    public function previous() {
        return $this->current_page - 1;
    }

    public function page_total() {
        return ceil($this->items_count/$this->items_per_page);
    }

    public function has_previous() {
        return $this->current_page > 1 ? true : false;
    }

    public function has_next() {
        return $this->current_page < $this->page_total() ? true : false;
    }

    public function offset() {
        return ($this->current_page -1) * $this->items_per_page;
    }
}