<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Projects;
use AppBundle\Entity\Tasks;
use AppBundle\Form\Type\IssueType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Config\Definition\Exception\Exception;

class ProjectsController extends Controller
{
    /**
     * @Route("/projects", name="_projects")
     */
    public function indexAction(Request $request)
    {
        $projects = $this->getDoctrine()->getRepository('AppBundle:Projects')->findAll();
        $form = $this->get('form.factory')->createNamedBuilder('', 'form', [], [])
            ->add('q', 'text', array(
                'label' => '����� ����',
                'required' => false,
                'empty_data' => null
            ));
        return $this->render('AppBundle:Projects:index.html.twig', [
            "projects" => $projects
        ]);
    }
    /**
     * @Route("/project/work/{id}", name="_project_work")
     */
    public function workAction(Request $request, $id)
    {
        $project = $this->getDoctrine()->getRepository('AppBundle:Projects')->find($id);
        $issues =  $this->getDoctrine()->getRepository('AppBundle:Tasks')->findBy(
            ["project" => $project]
        );
        return $this->render('AppBundle:Projects:work.html.twig', [
            "project" => $project,
            "issues" => $issues,
        ]);
    }
    /**
     * @Route("/project/plan/{id}", name="_project_plan")
     */
    public function planAction(Request $request, $id)
    {
        $project = $this->getDoctrine()->getRepository('AppBundle:Projects')->find($id);
        $issues =  $this->getDoctrine()->getRepository('AppBundle:Tasks')->findBy(
            ["project" => $project]
        );
        return $this->render('AppBundle:Projects:plan.html.twig', [
            "project" => $project,
            "issues" => $issues,
        ]);
    }
    /**
     * @Route("/project/report/{id}", name="_project_report")
     */
    public function reportAction(Request $request, $id)
    {
        $project = $this->getDoctrine()->getRepository('AppBundle:Projects')->find($id);
        $issues =  $this->getDoctrine()->getRepository('AppBundle:Tasks')->findBy(
            ["project" => $project]
        );
        return $this->render('AppBundle:Projects:report.html.twig', [
            "project" => $project,
            "issues" => $issues,
        ]);
    }
    /**
     * @Route("/project/getList", name="_project_get_list")
     */
    public function getListAction(Request $request)
    {
        $return = ["success"=>false];
        $projectId = $request->get("projectId");
        $listName = $request->get("listName");
        $project = $this->getDoctrine()->getRepository('AppBundle:Projects')->find($projectId);
        $list = $this->getDoctrine()->getRepository('AppBundle:Lists')->findOneBy(
            ["name"=>$listName]
        );

        $return["html"] = $this->get('twig')->render('AppBundle:Projects:_blocks/list/listContent.html.twig', [
            "project" => $project,
            "list" => $list
        ]);
        $return["success"] = true;
        return new JsonResponse($return);
    }
    /**
     * @Route("/project/getIssue", name="_project_get_issue")
     */
    public function getIssueAction(Request $request)
    {
        $histories = [];
        $attachments = [];
        $comments = [];
        $return = ["success"=>false];
        if($request->get("isEdit")) {
            $issueId = $request->get("issueId");
            $issue = $this->getDoctrine()->getRepository('AppBundle:Tasks')->find($issueId);

            if(!empty($issue)) {
                $histories = $this->getDoctrine()->getRepository('AppBundle:HistoryLog')->findBy(
                    [
                        "task" => $issue
                    ],
                    [
                        "historyDate" => "DESC"
                    ]
                );
            }
        }
        else {
            $projectId = $request->get("projectId");
            $issue = new Tasks();
            $project = $this->getDoctrine()->getRepository("AppBundle:Projects")->find($projectId);
            $issue->setProject($project);
        }

        //$form = $this->get('form.factory')->createNamedBuilder('', 'form', [], [])
        $form = $this->createForm("IssueType", $issue, array('csrf_protection' => false));

        $return["html"] = $this->get('twig')->render('AppBundle:Projects:_blocks/issue/editForm.html.twig', [
            "issue" => $issue,
            "histories" => $histories,
            "attachments" => $attachments,
            "comments" => $comments,
            "form" => $form->createView()
        ]);
        $return["success"] = true;
        return new JsonResponse($return);
    }
    /**
     * @Route("/project/saveIssue", name="_project_save_issue")
     */
    public function saveIssueAction(Request $request)
    {
        $IssueTypeParams = $request->get("IssueType");
        $histories = [];
        $attachments = [];
        $comments = [];
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user=="anon.") {
            $user = null;
        }
        $return = ["success"=>false,"error"=>[]];
        if(empty($request->get("issueId"))) {
            $issue = new Tasks();
        }
        else{
            $issue = $this->getDoctrine()->getRepository("AppBundle:Tasks")->find($request->get("issueId"));
        }
        if(empty($issue)) {
            $project = $this->getDoctrine()->getRepository("AppBundle:Projects")->find($IssueTypeParams["project"]);
            $issue = new Tasks();
            $issues = $this->getDoctrine()->getRepository("AppBundle:Tasks")->findBy(
                ["project" => $project]
            );
            $issue->setName($project->getName()."-".(count($issues)+1));
            $issue->setDateCreate(new \DateTime());
            $issue->setUserCreate($user);
        }
        $issue->setDeleted(0);
        $issue->setStatus("NEW");
        //$issue->setUserCreate($user);
        $form = $this->createForm("IssueType", $issue, array('csrf_protection' => false));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            try {
                $em->persist($issue);
                $em->flush();
                $this->addFlash(
                    'success',
                    'Success! Issue saved.'
                );
                $return["success"] = true;
                $return["html"] = $this->get('twig')->render('AppBundle:Projects:_blocks/issue/editForm.html.twig', [
                    "issue" => $issue,
                    "histories" => $histories,
                    "attachments" => $attachments,
                    "comments" => $comments,
                    "form" => $form->createView()
                ]);
            }
            catch(Exception $e){
                $return["error"][] = $e->getMessage();
            }
        }
        else {
            $this->addFlash(
                'error',
                'Error! Invalid form data.'
            );
            foreach($form->getErrors() as $error) {
                $return["error"][] = $error->getMessage();
            }
            $return["html"] = $this->get('twig')->render('AppBundle:Projects:_blocks/issue/editForm.html.twig', [
                "issue" => $issue,
                "histories" => $histories,
                "attachments" => $attachments,
                "comments" => $comments,
                "form" => $form->createView()
            ]);
        }
        return new JsonResponse($return);
    }
    /**
     * @Route("/project/getProject", name="_project_get_project")
     */
    public function getProjectAction(Request $request)
    {
        $return = ["success"=>false];
        if($request->get("isEdit")) {
            $projectId = $request->get("projectId");
            $project = $this->getDoctrine()->getRepository('AppBundle:Projects')->find($projectId);
            if(!empty($project)) {
            }
        }
        else {
            $project = new Projects();
        }

        //$form = $this->get('form.factory')->createNamedBuilder('', 'form', [], [])
        $form = $this->createForm("ProjectType", $project, array('csrf_protection' => false));

        $return["html"] = $this->get('twig')->render('AppBundle:Projects:_blocks/issue/projectForm.html.twig', [
            "project" => $project,
            "form" => $form->createView()
        ]);
        $return["success"] = true;
        return new JsonResponse($return);
    }
    /**
     * @Route("/project/saveProject", name="_project_save_project")
     */
    public function saveProjectAction(Request $request)
    {
        $ProjectTypeParams = $request->get("ProjectType");
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user=="anon.") {
            $user = null;
        }
        $return = ["success"=>false,"error"=>[]];
        if(empty($request->get("projectId"))) {
            $project = new Projects();
        }
        else{
            $project = $this->getDoctrine()->getRepository("AppBundle:Projects")->find($request->get("projectId"));
        }
        if(empty($project)) {
            $project = new Projects();
            $project->setDateCreate(new \DateTime());
            $project->setVisibled(1);
            $project->setDeleted(0);
        }
        //$issue->setUserCreate($user);
        $form = $this->createForm("ProjectType", $project, array('csrf_protection' => false));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            try {
                $em->persist($project);
                $em->flush();
                $this->addFlash(
                    'success',
                    'Success! Project saved.'
                );
                $return["success"] = true;
                $return["html"] = $this->get('twig')->render('AppBundle:Projects:_blocks/issue/projectForm.html.twig', [
                    "project" => $project,
                    "form" => $form->createView()
                ]);
            }
            catch(Exception $e){
                $return["error"][] = $e->getMessage();
            }
        }
        else {
            $this->addFlash(
                'error',
                'Error! Invalid form data.'
            );
            foreach($form->getErrors() as $error) {
                $return["error"][] = $error->getMessage();
            }
            $return["html"] = $this->get('twig')->render('AppBundle:Projects:_blocks/issue/projectForm.html.twig', [
                "project" => $project,
                "form" => $form->createView()
            ]);
        }
        return new JsonResponse($return);
    }
}