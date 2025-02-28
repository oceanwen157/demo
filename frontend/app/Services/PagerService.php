<?php

namespace app\Services;

use think\Paginator;

class PagerService extends Paginator
{
    public function render()
    {
        if ($this->hasPages()) {
            return sprintf(
                "<nav class='pagination'>%s%s</nav>",
                $this->getPageLinks(),
                $this->getSummary()
            );
        }
        return '';
    }

    protected function getPageLinks()
    {
        $output = "<div class='pagination-pages'>";
        
        if ($this->currentPage() > 1) {
            $output .= $this->getPrevButton();
        }

        foreach ($this->getUrls() as $page => $url) {
            $output .= $this->getPageButton($page, $url);
        }

        if ($this->currentPage() < $this->lastPage()) {
            $output .= $this->getNextButton();
        }

        $output .= "</div>";
        return $output;
    }

    protected function getSummary()
    {
        return sprintf(
            "<div class='pagination-summary' data-total='%s' data-first='%s' data-last='%s'>%s 条返回结果</div>",
            number_format($this->total()),
            $this->firstItem(),
            $this->lastItem(),
            number_format($this->total())
        );
    }

    protected function getPageButton($page, $url)
    {
        $selectedClass = $page == $this->currentPage() ? "button-selected" : "";
        return sprintf(
            '<a href="%s" class="button button-secondary %s" aria-label="Page %d">%d</a>',
            htmlentities($url),
            $selectedClass,
            $page,
            $page
        );
    }

    protected function getPrevButton()
    {
        return sprintf(
            '<a href="%s" class="button button-primary" aria-label="Previous Page"><i class="icon-prev far fa-chevron-left"></i></a>',
            $this->url($this->currentPage() - 1)
        );
    }

    protected function getNextButton()
    {
        return sprintf(
            '<a href="%s" class="button button-primary" aria-label="Next Page"><i class="icon-start far fa-chevron-right"></i></a>',
            $this->url($this->currentPage() + 1)
        );
    }

    protected function getUrls()
    {
        $urls = [];
        $start = max(1, $this->currentPage() - 2);
        $end = min($this->lastPage(), $this->currentPage() + 2);
        for ($page = $start; $page <= $end; $page++) {
            $urls[$page] = $this->url($page);
        }
        return $urls;
    }

    public function firstItem()
    {
        return ($this->currentPage() - 1) * $this->listRows + 1;
    }

    public function lastItem()
    {
        $last = $this->currentPage() * $this->listRows;
        return $last < $this->total() ? $last : $this->total();
    }
}