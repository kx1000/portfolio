<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Form\LinkType;
use App\Form\TechnologyType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
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

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['listOrder' => 'ASC']);
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
            IntegerField::new('listOrder'),
            TextField::new('slug'),
            TextField::new('title'),
            TextareaField::new('body'),
            CollectionField::new('links')
                ->setEntryType(LinkType::class)
                ->setFormTypeOption('by_reference', false),
            CollectionField::new('technologies')
                ->setEntryType(TechnologyType::class)
                ->setFormTypeOptions([
                    'by_reference' => false,
                    'allow_delete' => true,
                    'allow_add' => true,
                ]),
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
