<?php

namespace App\Form;

use App\Entity\Navigation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;

class NavigationType extends AbstractType
{
    public function __construct(private RouterInterface $router)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $allRoutes = $this->router->getRouteCollection()->all();
        $availableRoutes = [];

        foreach ($allRoutes as $routeName => $route) {
            if (str_starts_with($routeName, '_')) { // Exclude routes starting with underscore
                continue;
            }
            $availableRoutes[$routeName] = $routeName;
        }

        $builder
            ->add('name')
            ->add('route', ChoiceType::class, [
                'choices' => $availableRoutes,
                'label' => 'Select Route',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Navigation::class,
        ]);
    }
}
