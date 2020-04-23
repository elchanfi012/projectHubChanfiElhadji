<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Task;
use App\Form\TaskType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @Route("/task/add/{project_id}", name="add_task")
     */
    public function addTask(Request $request, $project_id)
    {

        $projectRepository = $this->getDoctrine()->getRepository(Project::class);
        $project = $projectRepository->find($project_id);

        $task =new Task();

        $addTaskForm = $this->createForm(TaskType::class, $task);
        $addTaskForm->handleRequest($request);

        if($addTaskForm->isSubmitted() && $addTaskForm->isValid()){

            $task = $addTaskForm->getData();
            $task->setCreatedAt(new DateTime());
            $task->setProject($project);

            $this->getDoctrine()->getManager()->persist($task);
            $this->getDoctrine()->getManager()->flush();

        }

        return $this->render('task/add.html.twig', [
            'addTaskForm' => $addTaskForm->createView(),
            'project' => $project
        ]);
    }
}
