<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log; // Importando Log

class HandleApiExceptions
{
    /**
     * Handle an incoming request by catching any exceptions and returning a JSON response.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  \Illuminate\Http\Request  $request
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Processar a requisição normalmente
            return $next($request);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log para erro de recurso não encontrado
            Log::error('Resource not found.', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'error_code' => 'RESOURCE_NOT_FOUND',
                'message' => 'Resource not found.',
            ], 404);
        } catch (\Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException $e) {
            // Log para erro de acesso não autorizado
            Log::warning('Unauthorized access attempt.', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'error_code' => 'UNAUTHORIZED',
                'message' => 'Unauthorized access.',
            ], 401);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log para erro de validação
            Log::warning('Validation error.', ['error' => $e->errors()]);
            return response()->json([
                'success' => false,
                'error_code' => 'VALIDATION_ERROR',
                'message' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Log para erro genérico
            Log::error('An unexpected error occurred.', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'error_code' => 'INTERNAL_SERVER_ERROR',
                'message' => 'An unexpected error occurred.',
            ], 500);
        }
    }
}
