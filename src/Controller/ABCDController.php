<?php

namespace App\Controller;

use App\Entity\ABCD;
use App\Entity\Categories;
use App\Form\ABCDType;
use App\Form\AType;
use App\Form\CategoryType;
use App\Repository\ABCDRepository;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
class ABCDController extends AbstractController
{

    /**
     * @Route("/create", name="main_create")
     */

    public function create(Request $request,EntityManagerInterface $entityManager) : Response

    {

        $abcd = new ABCD();
        $abcdForm = $this->createForm(ABCDType::class,$abcd);

        $abcdForm->handleRequest($request);

        if($abcdForm->isSubmitted() && $abcdForm->isValid())
        {
            $entityManager->persist($abcd);
            $entityManager->flush();

            $this->addFlash('success', 'Ajout executé');
            return $this->redirectToRoute('main_home');
        }
        return $this->render('main/create.html.twig', [
            'abcdForm' => $abcdForm->createView()
        ]);
    }


    /**
     * @Route("/a", name="main_a")
     */

    public function a(ABCDRepository $ABCDRepository,Request $request,EntityManagerInterface $entityManager,CategoriesRepository $categoriesRepository):Response
    {

        $category = new Categories();
        $categoryForm = $this->createForm(CategoryType::class,$category);
        $categoryForm->handleRequest($request);


        $alistes= $ABCDRepository->findBy([],['name'=>'ASC']);

        return $this->render('main/a.html.twig',[

            'alistes'=>$alistes,
            'categoryForm'=>$categoryForm->createView()

        ]);
    }

    /**
     * @Route("/adetail/{id}", name="main_adetail")
     */
    public function detail(int $id,ABCDRepository $ABCDRepository):Response
    {
        $a= $ABCDRepository->find($id);

        return $this->render('main/adetail.html.twig',[
            'a'=>$a
        ]);
    }

    /**
     * @Route("/b", name="main_b")
     */

    public function b(ABCDRepository $ABCDRepository,Request $request,EntityManagerInterface $entityManager,CategoriesRepository $categoriesRepository):Response
    {

        $category = new Categories();
        $categoryForm = $this->createForm(CategoryType::class,$category);
        $categoryForm->handleRequest($request);


        $blistes= $ABCDRepository->findBy([],['name'=>'ASC']);

        return $this->render('main/b.html.twig',[

            'blistes'=>$blistes,
            'categoryForm'=>$categoryForm->createView()

        ]);
    }

    /**
     * @Route("/bdetail/{id}", name="main_bdetail")
     */
    public function detailB(int $id,ABCDRepository $ABCDRepository):Response
    {
        $b= $ABCDRepository->find($id);

        return $this->render('main/bdetail.html.twig',[
            'b'=>$b
        ]);
    }
}