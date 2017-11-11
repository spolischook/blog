<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TagsFixtures extends Fixture
{
    private $tags = [
        'symfony',
        'art',
        'geekhub',
    ];

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->tags as $name) {
            $entity = new Tag();
            $entity->setName($name);

            $manager->persist($entity);
            $this->addReference('tag_'.$name, $entity);
        }

        $manager->flush();
    }
}
