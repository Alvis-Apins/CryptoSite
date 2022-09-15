<?php

namespace App\Repositories;

use App\Models\Article;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class NewsDataApiRepository implements ApiRequest
{
    public function getApiData()
    {
        DB::table('articles')->truncate();
        for ($i = 1; $i <= 2; $i++) {
            $client = new Client([
                'base_uri' => 'https://api.newscatcherapi.com'
            ]);
            $response = $client->request('GET', '/v2/search', [
                'headers' => ['x-api-key' => '4s5xVQCIfHc02aA9JGA0KPY4EsEv2lUn8kH-3hgCZq8'],
                'query' => [
                    'q' => 'crypto',
                    "sources" => "forbes.com,coindesk.com,benzinga.com,businessinsider.com,cnbc.com,yahoo.com",
                    'lang' => 'en',
                    "countries" => "US,GB",
                    'sort_by' => 'date',
                    "page_size" => 100,
                    'page' => $i,
                    "topic" => "business",
                ]
            ]);
            $cryptoNews = json_decode($response->getBody());

            foreach ($cryptoNews->articles as $news) {
                if ($news->media == null) continue;

                $article = new Article();
                $article->title = $news->title;
                $article->content = substr($news->summary, 0, 300) . "...";
                if ($news->rights == null) {
                    $article->publisher = $news->authors;
                } else {
                    $article->publisher = $news->rights;
                }
                $article->link = $news->link;
                $article->media = $news->media;
                $article->created_at = $news->published_date;
                $article->save();
            }
        }
    }
}
