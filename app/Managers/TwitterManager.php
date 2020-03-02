<?php

namespace App\Managers;

use Carbon\Carbon;
use App\Entities\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Thujohn\Twitter\Twitter;
use App\Dictionaries\StatusDictionary;
use App\Dictionaries\PostTypeDictionary;
use App\Entities\Settings\SocialNetworks\SocialLink;
use App\Repositories\Dashboard\SocialNetworks\SocialLinkRepository;
use App\Repositories\Dashboard\SocialNetworks\SocialNetworkRepository;

class TwitterManager
{
    public const FORMAT = 'array';
    public const LIMIT  = 5;

    private $twitter;

    private $networkRepository;

    private $linkRepository;

    public function __construct(
        Twitter $twitter,
        SocialNetworkRepository $networkRepository,
        SocialLinkRepository $linkRepository
    )
    {
        $this->twitter = $twitter;
        $this->networkRepository = $networkRepository;
        $this->linkRepository = $linkRepository;
    }

    public function import()
    {
        $network = $this->networkRepository->getOneBy([
            'name' => PostTypeDictionary::getValueByKey(PostTypeDictionary::TYPE_TWITTER),
        ]);

        $links = $this->linkRepository->getAll(['network_id' => $network->id]);

        $links->each(function (SocialLink $link) {
            $user = $this->getUserName($link->link);

            $twitts = $this->twitter->getUserTimeline(['screen_name' => $user, 'count' => self::LIMIT, 'format' => self::FORMAT]);

            $posts = [];

            foreach ($twitts as $twitt) {
                $posts[] = [
                    'type'      => PostTypeDictionary::TYPE_TWITTER,
                    'title'     => Str::limit($twitt['text'], 30),
                    'post_id'   => $twitt['id'],
                    'coin_id'   => $link->coin_id,
                    'text'      => $twitt['text'],
                    'created'   => Carbon::parse($twitt['created_at'])->format('Y-m-d H:i'),
                    'user_id'   => $twitt['user']['id'],
                    'user_name' => $twitt['user']['name'],
                    'shares'    => $twitt['retweet_count'],
                    'likes'     => $twitt['favorite_count'],
                    'status'    => StatusDictionary::ACTIVE,
                ];
            }

            if ($posts) {
                Post::insert($posts);
            }
        });
    }

    protected function getUserName(string $link): string
    {
        return Arr::last(explode('/', $link));
    }
}