<?php

/**
 * @OA\Schema(
 *     schema="StoreUserRequest",
 *     type="object",
 *     required={"email", "password", "full_name", "photo_url"},
 *     @OA\Property(property="email", type="string", format="email", example="user@example.com"),
 *     @OA\Property(property="password", type="string", format="password", example="password123"),
 *     @OA\Property(property="full_name", type="string", example="John Doe"),
 *     @OA\Property(property="photo_url", type="string", format="url", example="http://example.com/photo.jpg")
 * )
 *
 * @OA\Schema(
 *     schema="UpdateUserRequest",
 *     type="object",
 *     required={"email", "password", "full_name", "photo_url"},
 *     @OA\Property(property="email", type="string", format="email", example="user@example.com"),
 *     @OA\Property(property="password", type="string", format="password", example="password123"),
 *     @OA\Property(property="full_name", type="string", example="John Doe"),
 *     @OA\Property(property="photo_url", type="string", format="url", example="http://example.com/photo.jpg")
 * )
 *
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="email", type="string", format="email", example="user@example.com"),
 *     @OA\Property(property="full_name", type="string", example="John Doe"),
 *     @OA\Property(property="photo_url", type="string", format="url", example="http://example.com/photo.jpg"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2020-01-01T00:00:00.000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2020-01-01T00:00:00.000Z")
 * )
 */
