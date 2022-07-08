<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminModifForm extends AbstractController
{
    public function new(Request $request): Response
    {
        $updateForm = new UpdateForm();

        $form = $this->createForm(UpdateFormType::class, $updateForm);
    }
}