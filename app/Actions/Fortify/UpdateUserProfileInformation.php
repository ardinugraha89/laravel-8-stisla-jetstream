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

        //dd($input);
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'numeric', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'max:1024'],
            'user_detail.nik' => ['required', 'numeric', Rule::unique('user_details', 'nik')->ignore($user->id, 'user_id')],
            'user_detail.npwp' => ['required', 'string', Rule::unique('user_details', 'npwp')->ignore($user->id, 'user_id')],
            'user_detail.jenis_kelamin' => ['required'],
            'user_detail.tempat_lahir' => ['required', 'string'],
            'user_detail.tanggal_lahir' => ['required', 'string'],
            'user_detail.alamat' => ['required', 'string'],
            'user_detail.email' => ['required', 'email', Rule::unique('user_details', 'email')->ignore($user->id, 'user_id')],
            'user_detail.telepon' => ['required', 'string', Rule::unique('user_details', 'telepon')->ignore($user->id, 'user_id')]
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }
        if (
            $input['user_detail']['email'] !== $userDetail->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'nip' => $input['nip'],
            ])->save();
            $userDetail->forceFill([
                'tanggal_lahir' => $input['user_detail']['tanggal_lahir'],
                'tempat_lahir' => $input['user_detail']['tempat_lahir'],
                'alamat' => $input['user_detail']['alamat'],
                'jenis_kelamin' => $input['user_detail']['jenis_kelamin'],
                'telepon' => $input['user_detail']['telepon'],
                'email' => $input['user_detail']['email'],
                'nik' => $input['user_detail']['nik'],
                'npwp' => $input['user_detail']['npwp'],
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
            'tanggal_lahir' => $input['user_detail']['tanggal_lahir'],
            'tempat_lahir' => $input['user_detail']['tempat_lahir'],
            'alamat' => $input['user_detail']['alamat'],
            'jenis_kelamin' => $input['user_detail']['jenis_kelamin'],
            'telepon' => $input['user_detail']['telepon'],
            'email' => $input['user_detail']['email'],
            'nik' => $input['user_detail']['nik'],
            'npwp' => $input['user_detail']['npwp'],
            'user_id' => $user->id,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
