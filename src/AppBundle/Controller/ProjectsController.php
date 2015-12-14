<?php

namespace AppBundle\Controller;

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
                'label' => 'Поиск дома',
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
        $return = ["success"=>false];
        if($request->get("isEdit")) {
            $issueId = $request->get("issueId");
            $issue = $this->getDoctrine()->getRepository('AppBundle:Tasks')->find($issueId);
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
        $return = ["success"=>false,"error"=>[]];
        if(empty($request->get("issueId"))) {
            $issue = new Tasks();
        }
        else{
            $issue = $this->getDoctrine()->getRepository("AppBundle:Tasks")->find($request->get("issueId"));
        }
        if(empty($issue)) {
            $issue = new Tasks();
        }
        $issue->setDeleted(0);
        $issue->setStatus("NEW");
        $issue->setDateCreate(new \DateTime());
        //$issue->setUserCreate($user);
        $form = $this->createForm("IssueType", $issue, array('csrf_protection' => false));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            try {
                $em->persist($issue);
                $em->flush();
                $return["success"] = true;
                $return["html"] = $this->get('twig')->render('AppBundle:Projects:_blocks/issue/editForm.html.twig', [
                    "issue" => $issue,
                    "form" => $form->createView()
                ]);
            }
            catch(Exception $e){
                $return["error"][] = $e->getMessage();
            }
        }
        else {
            foreach($form->getErrors() as $error) {
                $return["error"][] = $error->getMessage();
            }
        }
        return new JsonResponse($return);
    }
}