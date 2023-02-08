<?php

declare(strict_types=1);

namespace App\Domain\Client\UseCase\Edit;

use App\Domain\Client\Entity\Education\Education;
use App\Domain\Client\Entity\Operator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


final class Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('first_name', TextType::class);
        $builder->add('last_name', TextType::class);
        $builder->add('phone', TextType::class);
        $builder->add('email', EmailType::class);
        $builder->add('operator', ChoiceType::class, [
            'choices' => array_flip(Operator::getNames())
        ])->add('education', ChoiceType::class, [
            'choices' => array_flip(Education::getNames())
        ])->add('consent_personal_data', CheckboxType::class, [
                'label' => 'Я даю согласие на обработку моих личных данных',
            'required' => false
        ])->add('send', SubmitType::class, ['label' => 'Отправить']);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Command::class,
        ]);
    }
}