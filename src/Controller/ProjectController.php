<?php

namespace App\Controller;

use App\Entity\Manager;
use App\Entity\Project;
use App\Entity\Task;
use App\Form\ProjectType;
use App\Form\StatusType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/", name="projects")
     */
    public function showAllProjects(Request $request)
    {

        $projectRepository = $this->getDoctrine()->getRepository(Project::class);
        $projects = $projectRepository->findAll();




        return $this->render('project/list.html.twig', [
            'projects' => $projects
        ]);
    }

    
    /**
     * @Route("/project/add", name="add_project")
     */
    public function addProject(Request $request)
    {
        $project = new Project();

        $addProjectForm = $this->createForm(ProjectType::class, $project);
        $addProjectForm->handleRequest($request);

        if($addProjectForm->isSubmitted() && $addProjectForm->isValid()){

            $project = $addProjectForm->getData();
            $project->setStartedAt(new DateTime());
            $project->setStatus("Nouveau");

            $this->getDoctrine()->getManager()->persist($project);
            $this->getDoctrine()->getManager()->flush();

        }

        return $this->render('project/add.html.twig', [
            'addProjectForm' => $addProjectForm->createView()
        ]);
    }

    /**
     * @Route("/project/{project_id}", name="detail_project")
     */
    public function showProject(Request $request, $project_id)
    {
        $projectRepository = $this->getDoctrine()->getRepository(project::class);
        $project = $projectRepository->find($project_id);

        $status = $project->getStatus();
        if($request->request->has('status')){
            $project->setStatus($request->request->get('status'));

            $this->getDoctrine()->getManager()->persist($project);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('project/detail.html.twig', [
            'project' => $project,
        
        ]);
    }


}
