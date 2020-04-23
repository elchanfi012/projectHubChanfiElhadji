<?php

namespace App\DataFixtures;

use App\Entity\Manager;
use App\Entity\Project;
use App\Entity\Task;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $user = new Manager();
        $user->setUsername("echanfi");
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$WFBic01DdE5kcVZMdENKYQ$hjjZwaqBBxZtodOSJ65G8Hu+VdRiv3YWzCzlncLMxf4');
        $user->setCreatedAt(new DateTime());
        $manager->persist($user);
        for ($i=0; $i < 5; $i++) { 
            $project = new Project();
            $project->setName("project$i");
            $project->setStartedAt(new DateTime());
            $project->setStatus("Nouveau");
            $manager->persist($project);

            

            for ($j=0; $j < 2; $j++) { 
                $task = new Task();
                $task->setProject($project);
                $task->setTitle("title$j");
                $task->setDescription("description$j");
                $task->setCreatedAt(new DateTime());
                $manager->persist($task);
            }

    }
        $manager->flush();
    }
}
