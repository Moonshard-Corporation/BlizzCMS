<?php

namespace App\Controllers;

use App\Models\NewsComment;
use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */

class News extends BaseController
{
    public function index(): string
    {
        $inputPage = $this->request->getVar('page') ?? 1;
        $page = ctype_digit((string) $inputPage) ? (int) $inputPage : 1;

        $newsModel = new \App\Models\News();

        $perPage = configItem('articles_per_page') ?? 25;

        $data = [
            'articles' => $newsModel->paginate($perPage),
            'pagination' => $newsModel->pager->makeLinks($page, $perPage, $newsModel->countAllResults(), 'foundation_full'),
            'aside' => $newsModel->latest()
        ];

        $this->template->setTitle(lang('General.news'), configItem('app_name'));
        return $this->template->build('articles', $data);
    }

    /**
     * View a single article
     * 
     * @param int|null $id
     * @param string|null $slug
     * @return string
     */
    public function view(int $id = null, string $slug = null): string
    {
        $newsModel = new \App\Models\News();
        $commentsModel = new NewsComment();

        $article = $newsModel->where('id', $id)->where('slug', $slug)->first();

        if (empty($article)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $inputPage = $this->request->getVar('page') ?? 1;
        $page = ctype_digit((string) $inputPage) ? (int) $inputPage : 1;

        $perPage = configItem('comments_per_page') ?? 25;

        $data = [
            'article' => $article,
            'comments' => $commentsModel->where('news_id', $id)->paginate($perPage),
            'pagination' => $commentsModel->pager->makeLinks($page, $perPage, $commentsModel->countAllResults(), 'foundation_full'),
            'aside' => $newsModel->latest()
        ];

        $this->template->setTitle($article->title, configItem('app_name'));
        $this->template->setSeoMetas([
            'title'       => $article->title,
            'description' => $article->metaDescription,
            'robots'      => $article->metaRobots,
            'type'        => 'article',
            'url'         => current_url()
        ]);

        $this->template->addJs(['src' => base_url('assets/tinymce/tinymce.min.js'), 'referrerpolicy' => 'origin']);
        $this->template->addJs(base_url('assets/js/tmce-comment.js'));

        return $this->template->build('article', $data);
    }
}
