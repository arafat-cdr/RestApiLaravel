<?php

namespace App\Exceptions;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

trait ExceptionTrait {

	public function apiException($request, $e) {

		if( $this->isModel($e) ) {

		    return $this->ModelResponse();
		}

		if( $this->isHttp($e) ) {

		    return $this->HttpResponse();
		}

		return parent::render($request, $e);
	}

	protected function isModel($e) {

		return $e instanceof ModelNotFoundException;
	}

	protected function isHttp($e) {

		return $e instanceof NotFoundHttpException;
	}

	protected function ModelResponse() {

		return response()->json([
		        'errors' => 'product Model Not found'

		    ], Response::HTTP_NOT_FOUND);
	}

	protected function HttpResponse() {

		return response()->json([
		        'errors' => 'Incorrect Route'

		    ], Response::HTTP_NOT_FOUND);
	}
}