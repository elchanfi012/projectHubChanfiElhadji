<?php

namespace App\Controller;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/projects", name="api_projects", methods={"GET"})
     */
    public function showAllProjects(Request $request, SerializerInterface $serialzer)
    {

        $projectRepository = $this->getDoctrine()->getRepository(Project::class);
        $projects = $projectRepository->findAll(); 

        $listProjects = [];

        foreach($projects as $project){
            $listProjects[$project->getId()] = $project->getName();
        }

        $jsonProjects = json_encode($listProjects);


        return new JsonResponse($jsonProjects, 200, [], true);
    }

    /**
     * @Route("/api/project/{project_id}", name="api_project", methods={"GET"})
     */
    public function showProject(Request $request, SerializerInterface $serialzer, $project_id)
    {
        $projectRepository = $this->getDoctrine()->getRepository(Project::class);
        $project = $projectRepository->find($project_id); 

        $listTasks = [];

        foreach($project->getTasks() as $task){
            $listTasks[$task->getId()] = $task->getTitle();
        }

        $jsonTasks = json_encode($listTasks);

        return new JsonResponse($jsonTasks, 200, [], true);
    }
    
}
