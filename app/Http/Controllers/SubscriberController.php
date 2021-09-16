<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Carbon;



class SubscriberController extends Controller
{


    public function search(Request $request)
	{
		$search = $request->searchBox;
		$admins = Auth::user();
		$searchedSubs = Subscriber::where('name' , 'LIKE' , '%' . $search . '%')->where('user_id' , Auth::user()->id)->get();
		return view('searched.searched-subscribers' , compact('searchedSubs','admins'));
	}

	 

	public function searchDeletedSubscribers(Request $request)
	{
		$search = $request->searchBox;
		$admins = Auth::user();
		$deletedSubs = Subscriber::onlyTrashed()->where('name' , 'LIKE' , '%' . $search)->where('user_id' , Auth::user()->id)->get();
		return view('searched.search-deleted-subscribers' , compact('deletedSubs','admins'));
	}


    public function store(Request $request)
    {
    	$rules = $this->getRules();
    	$messages = $this->getMessages();
    	$validator = Validator::make($request->all() , $rules , $messages);

    	if($validator -> fails())
       	{
           return  redirect()->back()->withErrors($validator)->withInputs($request->all())->with(['messages'=>$messages]) ;
      	 }


    	$subscribers = new Subscriber();
    	$subscribers->name = $request->username;
    	$subscribers->email = $request->email;
    	$subscribers->mobile = $request->mobile;
    	$subscribers->payment_date = Carbon::now();
    	$subscribers->expire_date = Carbon::now()->addMonth();
    	$subscribers->price = $request->price;
    	$subscribers->user_id = Auth::user()->id;
    	$subscribers->save();

    	return redirect('/dashboard/'.Auth::user()->id);

    }

  
    	public function showUpdateForm(Request $request)
    	{
    		$details = $request->details;
    		$subscribers = Subscriber::where('id',$details)->get();
    		return view('searched.updateForm' , compact('subscribers'));
    	}



		public function update(Request $request , $subscriber_id)
		{
				$subscribers = Subscriber::find($subscriber_id);
				$subscribers->name = $request->name;
				$subscribers->email = $request->email;
				$subscribers->mobile = $request->mobile;
				$subscribers->price = $request->price;
				$subscribers->update();
				return redirect('/dashboard/'.Auth::user()->id);
			}

			public function mobileUpdate(Request $request , $subscriber_id)
			{
				$subscribers = Subscriber::find($subscriber_id);
				$subscribers->name = $request->mName;
				$subscribers->email = $request->mEmail;
				$subscribers->mobile = $request->mMobile;
				$subscribers->price = $request->mPrice;
				$subscribers->update();
				return redirect('/dashboard/'.Auth::user()->id);
			}	


    public function delete($subscriber_id)
    {
    	$subscribers = Subscriber::find($subscriber_id);
    	if (!$subscribers) {
    		return response()->json(['message'=>'an error occurred']);
    	}
    	$subscribers->delete();
    	return redirect('/dashboard/'.Auth::user()->id);
    }


	public function restore(Request $request , $subscriber_id)
		{
			$subscribers = Subscriber::onlyTrashed()->find($subscriber_id);
			$subscribers->expire = 1;
      $subscribers->payment_date = Carbon::now();
      $subscribers->expire_date = Carbon::now()->addMonth();
			$subscribers->restore();
			return redirect('/dashboard/'.Auth::user()->id);
		}

	public function erase($admin_id)
		{
			$admin = User::find($admin_id) ;
			$admin->subscribers()->withTrashed()->forceDelete();
			return back();
		}




		//__________________________________________________________//


		protected function getRules()
		{
			return $rules = [

				'email'	    => 'unique:subscribers|nullable',
				'mobile'    => 'unique:subscribers|nullable',


			];
		}


		protected function getMessages()
		{
			return $messages = [
				'email.unique'	     => 'هذا البريد موجود !',

				'mobile.unique'   	 => 'رقم الهاتف موجود !'


			];
		}



	
}
