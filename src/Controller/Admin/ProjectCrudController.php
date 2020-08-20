<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProjectCrudController extends AbstractCrudController
{
    private $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::DETAIL)
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('slug'),
            TextField::new('title'),
            TextEditorField::new('body'),
            ImageField::new('image')
                ->setBasePath($this->parameterBag->get('project_images_path'))
                ->hideOnForm(),
            ImageField::new('imageFile')
                ->setFormType(VichImageType::class)
                ->hideOnIndex()
                ->hideOnDetail(),
            ImageField::new('animation')
                ->setBasePath($this->parameterBag->get('project_animations_path'))
                ->hideOnForm(),
            ImageField::new('animationFile')
                ->setFormType(VichImageType::class)
                ->hideOnIndex()
                ->hideOnDetail(),
        ];
    }

}
