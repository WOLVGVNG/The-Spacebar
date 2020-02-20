<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixture extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Comment::class, 100, function(Comment $comment, $count) {
            $article = $this->getRandomReference(Article::class);
            $comment->setAuthorName($this->faker->name)
                ->setContent($this->faker->realText(100))
                ->setIsDeleted($this->faker->boolean(20))
                ->setArticle($article);

            if ($article->getPublishedAt()) {
                $comment->setCreatedAt($this->faker->dateTimeBetween($article->getPublishedAt(), '-1 seconds'));
            }
        });
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            ArticleFixtures::class
        ];
    }
}
