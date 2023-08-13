<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class PostCrudController extends AbstractCrudController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureFields(string $pageName): iterable
    {
        // Fetch users with the role "ROLE_USER"
        $users = $this->userRepository->findUsersWithRoleUser();

        // Create an associative array with the format 'first_name last_name' => id
        $userChoices = [];
        foreach ($users as $user) {
            $userChoices[$user->getFirstName() . ' ' . $user->getLastName()] = $user->getId();
        }

        return [
            TextField::new('title'),
            AssociationField::new('author')
                ->setLabel('Author')
                ->setFormTypeOptions([
                    'query_builder' => function (UserRepository $userRepository) {
                        return $userRepository->createQueryBuilder('u')
                            ->where('u.roles LIKE :role')
                            ->setParameter('role', '%"ROLE_USER"%');
                    },
                ]),
            AssociationField::new('taxonomy')
                ->setLabel('Tags')
                ->setFormTypeOptions([
                    'by_reference' => false, // Important for ManyToMany
                    'multiple' => true
                ]),
            TextEditorField::new('short_description'),
            TextEditorField::new('content'),
            ImageField::new('image')
                ->setBasePath('uploads/images')
                ->setUploadDir('public/uploads/images')
                ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
                ->setLabel('Image'),
            BooleanField::new('published')
        ];
    }
    /**
     * @param Crud $crud
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['title' => 'ASC'])
            ->setPaginatorPageSize(15);
    }
}
