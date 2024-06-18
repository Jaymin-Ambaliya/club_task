<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("club.list");
    }
    public function fetchdata(Request $request)
    {
        $data = Club::latest('id')->get();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedClub = $request->validate([
            'group_id' => ['required'],
            'business_name' => ['required'],
            'club_number' => ['required'],
            'club_name' => ['required'],
            'club_state' => ['required'],
            'club_description' => ['required'],
            'club_slug' => ['required'],
            'website_title' => ['required'],
            'website_link' => ['required'],
            'club_logo' => ['required'],
            'club_banner' => ['required'],
        ], [
            'group_id.required' => 'Group Id field is required.',
            'business_name.required' => 'Business Name field is required.',
            'club_number.required' => 'Club Number field is required.',
            'club_name.required' => 'Club Name field is required',
            'club_state.required' => 'Club State field is required.',
            'club_description.required' => 'Club Description field is required.',
            'club_slug.required' => 'club Slug field is required.',
            'website_title.required' => 'Type field is required',
            'website_link.required' => 'Website Title field is required.',
            'club_logo.required' => 'Club Logo field is required.',
            'club_banner.required' => 'Club Banner field is required.',
        ]);

        $logofile = $request->file('club_logo');
        $extLogo = time() . $logofile->getClientOriginalName();
        $logofile->move(public_path('/upload/logos/'), $extLogo);

        $bannerfile = $request->file('club_banner');
        $extBanner = time() . $bannerfile->getClientOriginalName();
        $bannerfile->move(public_path('/upload/banners/'), $extBanner);

        Club::create([
            'group_id' => $request->group_id,
            'business_name' => $request->business_name,
            'club_number' => $request->club_number,
            'club_name' => $request->club_name,
            'club_state' => $request->club_state,
            'club_description' => $request->club_description,
            'club_slug' => $request->club_slug,
            'website_title' => $request->website_title,
            'website_link' => $request->website_link,
            'club_logo' => $extLogo,
            'club_banner' => $extBanner,
        ]);


        return response()->json(['success' => 'Club  created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Club $club)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $club = Club::where($where)->first();
        return response()->json($club);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $club = Club::findOrFail($id);
        $image_logo = public_path() . '/upload/logos/' . $club->club_logo;
        unlink($image_logo);
        $image_banner = public_path() . '/upload/banners/' . $club->club_banner;
        unlink($image_banner);

        $validatedClub = $request->validate([
            'group_id' => ['required'],
            'business_name' => ['required'],
            'club_number' => ['required'],
            'club_name' => ['required'],
            'club_state' => ['required'],
            'club_description' => ['required'],
            'club_slug' => ['required'],
            'website_title' => ['required'],
            'website_link' => ['required'],
            'club_logo' => ['required'],
            'club_banner' => ['required'],
        ], [
            'group_id.required' => 'Group Id field is required.',
            'business_name.required' => 'Business Name field is required.',
            'club_number.required' => 'Club Number field is required.',
            'club_name.required' => 'Club Name field is required',
            'club_state.required' => 'Club State field is required.',
            'club_description.required' => 'Club Description field is required.',
            'club_slug.required' => 'club Slug field is required.',
            'website_title.required' => 'Type field is required',
            'website_link.required' => 'Website Title field is required.',
            'club_logo.required' => 'Club Logo field is required.',
            'club_banner.required' => 'Club Banner field is required.',
        ]);

        $logofile = $request->file('club_logo');
        $extLogo = time() . $logofile->getClientOriginalName();
        $logofile->move(public_path('/upload/logos/'), $extLogo);

        $bannerfile = $request->file('club_banner');
        $extBanner = time() . $bannerfile->getClientOriginalName();
        $bannerfile->move(public_path('/upload/banners/'), $extBanner);

        $club->update([
            'group_id' => request('group_id'),
            'business_name' => request('business_name'),
            'club_number' => request('club_number'),
            'club_name' => request('club_name'),
            'club_state' => request('club_state'),
            'club_description' => request('club_description'),
            'club_slug' => request('club_slug'),
            'website_title' => request('website_title'),
            'website_link' => request('website_link'),
            'club_logo' => $extLogo,
            'club_banner' => $extBanner,
        ]);

        return response()->json(['success' => 'Club  created successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $club = Club::findOrFail($id);
        $image_logo = public_path() . '/upload/logos/' . $club->club_logo;
        unlink($image_logo);
        $image_banner = public_path() . '/upload/banners/' . $club->club_banner;
        unlink($image_banner);
        $club->delete();

        return response()->json($club);
    }
}
