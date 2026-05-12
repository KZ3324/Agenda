<?php

namespace App\Infrastructure\Http\Controller;

use App\Application\UseCase\CreateBooking;
use App\Application\UseCase\ListBookings;
use App\Domain\Repository\BookingRepositoryInterface;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class BookingController extends AbstractController
{
    public function __construct(private BookingRepositoryInterface $booking_repository) {}

    #[Route('/bookings', name:"app_booking_list", methods:['GET'])]
    public function index(ListBookings $useCase) : JsonResponse {
        return new JsonResponse($useCase->execute());
    }

    #[Route('/bookings', name: "app_booking_create", methods: ['POST'])]
    public function create(Request $request, CreateBooking $useCase): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $booking = $useCase->execute(
                $data['customer_name'],
                new DateTime($data['start_date']),
                new DateTime($data['end_date'])
            );

            return new JsonResponse([
                'id' => $booking->getId(),
                'status' => 'created'
            ], 201);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse([
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
