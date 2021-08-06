<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use App\Models\UserDetail;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */


    public function update($user, array $input)
    {

        $userDetail = new UserDetail();

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'numeric', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'max:1024'],
            'nik' => ['required', 'numeric', Rule::unique('user_details', 'nik')->ignore($user->id, 'user_id')],
            'npwp' => ['required', 'string', Rule::unique('user_details', 'npwp')->ignore($user->id, 'user_id')],
            'jenis_kelamin' => ['required'],
            'tempat_lahir' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('user_details', 'email')->ignore($user->id, 'user_id')],
            'telepon' => ['required', 'string', Rule::unique('user_details', 'telepon')->ignore($user->id, 'user_id')]
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }
        if (
            $input['email'] !== $userDetail->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'nip' => $input['nip'],
            ])->save();
            $userDetail->forceFill([
                'tanggal_lahir' => $input['tanggal_lahir'],
                'tempat_lahir' => $input['tempat_lahir'],
                'alamat' => $input['alamat'],
                'jenis_kelamin' => $input['jenis_kelamin'],
                'telepon' => $input['telepon'],
                'email' => $input['email'],
                'nik' => $input['nik'],
                'npwp' => $input['npwp'],
                'user_id' => $user->id,
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'nip' => $input['nip'],
        ])->save();

        $user->userDetail->forceFill([
            'tanggal_lahir' => $input['tanggal_lahir'],
            'tempat_lahir' => $input['tempat_lahir'],
            'alamat' => $input['alamat'],
            'jenis_kelamin' => $input['jenis_kelamin'],
            'telepon' => $input['telepon'],
            'email' => $input['email'],
            'email_verified_at' => null,
            'nik' => $input['nik'],
            'npwp' => $input['npwp'],
            'user_id' => $user->id,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
