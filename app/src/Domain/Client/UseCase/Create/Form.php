<?php

declare(strict_types=1);

namespace App\Domain\Client\UseCase\Create;

use App\Domain\Client\Entity\Education\Education;

use App\Domain\Client\Entity\Operator\Operator;
use App\Domain\Client\Query\Operator\Common\Fetcher;
use App\Domain\Client\Query\Operator\Common\Query;
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
    private Fetcher $fetcherOperatorCommon;
    private \App\Domain\Client\Query\Education\Common\Fetcher $fetcherEducationCommon;

    public function __construct(
        Fetcher $fetcherOperatorCommon,
        \App\Domain\Client\Query\Education\Common\Fetcher $fetcherEducationCommon
    )
    {
        $this->fetcherOperatorCommon = $fetcherOperatorCommon;
        $this->fetcherEducationCommon = $fetcherEducationCommon;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $operators = $this->fetcherOperatorCommon->column(new Query());
        $education = $this->fetcherEducationCommon->column(new \App\Domain\Client\Query\Education\Common\Query());

        $builder->add('first_name', TextType::class);
        $builder->add('last_name', TextType::class);
        $builder->add('phone', TextType::class);
        $builder->add('email', EmailType::class);
        $builder->add('operator', ChoiceType::class, [
            'choices' => array_flip($operators)
        ])->add('education', ChoiceType::class, [
            'choices' => array_flip($education)
        ])->add('consent_personal_data', CheckboxType::class, [
                'label' => 'Я даю согласие на обработку моих личных данных'
        ])->add('send', SubmitType::class, ['label' => 'Отправить']);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Command::class,
        ]);
    }
}