<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    private $articles = [
        'First' => [
            'title' => 'My very first article',
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent erat mi, '.
                'egestas eleifend lobortis et, scelerisque ut ipsum. Aliquam erat volutpat. '.
                'Quisque porta quam suscipit iaculis rhoncus. Donec malesuada eros sapien, '.
                'porta semper tortor finibus nec. Vivamus ac placerat lectus, pellentesque consectetur augue.',
            'tags' => ['tag_symfony', 'tag_art'],
        ],
        'Second' => [
            'title' => 'Second article',
            'text' => 'Quisque vehicula velit vitae leo porttitor, vel malesuada tellus iaculis. '.
                'Nunc non ipsum porttitor, convallis felis vel, mollis orci. Morbi sit amet laoreet tellus, '.
                'at varius sem. Integer convallis dui id velit euismod tristique vel ut dui. Ut massa nulla, '.
                'efficitur quis faucibus vel, facilisis eu urna. Phasellus a posuere augue. Aenean et gravida tellus. '.
                'Nunc finibus iaculis nulla. Morbi in elementum enim.',
            'tags' => ['tag_art', 'tag_geekhub'],
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->articles as $article) {
            $entity = new Article();
            $entity->setTitle($article['title'])
                ->setText($article['text'])
            ;

            foreach ($article['tags'] as $tag) {
                $entity->addTag($this->getReference($tag));
            }

            $manager->persist($entity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            TagsFixtures::class,
        );
    }
}
