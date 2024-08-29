<?php


namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index(Request $request)
    {

        $query = User::where(['is_deleted' => 0, 'role_id' => 2]);

        if ($request->ajax()) {
            $search = $request->input('search');
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('mobile', 'like', '%' . $search . '%');
                });
            }

            $clients = $query->orderBy('id', 'desc')->paginate(10);
            return response()->json([
                'clients' => $clients->items(),
                'pagination' => (string) $clients->links()
            ]);
        }

        $clients = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin.client', compact('clients'));
    }

    public function addClient(Request $request)
    {
        try {
            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
                'name' => [
                    'required', // Name field is required
                    'string', // Name must be a string
                    'max:25', // Maximum length of 25 characters
                    'regex:/^[a-zA-Z\s]+$/', // Only letters and spaces are allowed
                ],
                'mobile' => [
                    'required', // Mobile number is required
                    'digits:10', // Must be exactly 10 digits
                    'regex:/^[0-9]{10}$/', // Must contain only numbers
                    Rule::unique('users')->where(function ($query) {
                        return $query->where('is_deleted', 0); // Unique mobile number for non-deleted users
                    }),
                ],
            ], [
                // Custom error messages
                'name.required' => 'Please enter the client name.',
                'name.string' => 'The client name must be a valid string.',
                'name.max' => 'The client name must not exceed 25 characters.',
                'name.regex' => 'The client name should only contain letters and spaces.',
                'mobile.required' => 'Please enter the client mobile number.',
                'mobile.digits' => 'The mobile number must be exactly 10 digits.',
                'mobile.regex' => 'The mobile number should only contain digits.',
                'mobile.unique' => 'This mobile number is already associated with another user.',
            ]);

            // Check if the validation fails
            if ($validator->fails()) {
                // Redirect back with validation errors and input data
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

            // Proceed with storing client data if validation passes
            // Add your data storing logic here
            // Check if a user with the same mobile number and is_deleted = 1 exists
            $existingUser = User::where('mobile', $request->mobile)->where('is_deleted', 1)->first();

            if ($existingUser) {
                // Update the existing user with the new data
                $existingUser->update([
                    'name' => $request->name,
                    'email' => $request->email ?? null,
                    'password' => $request->password ? bcrypt($request->password) : $existingUser->password,
                    'is_deleted' => 0,
                    'role_id' => 2,
                ]);
            } else {
                // Create a new user
                User::create([
                    'name' => $request->name,
                    'email' => $request->email ?? null,
                    'mobile' => $request->mobile,
                    'password' => $request->password ? bcrypt($request->password) : null,
                    'role_id' => 2,
                ]);
            }

            return redirect()->route('clientpage')->with('success', 'Client added successfully');

        } catch (\Exception $e) {
            // Handle any exceptions that occur during the process
            return redirect()->back()->with('error', 'An error occurred while adding the client. Please try again.');
        }
    }


    public function editClient(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:20',
                'mobile' => [
                    'required',
                    'regex:/^[0-9()+-]+$/',
                    'min:4',
                    'max:15',
                ],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors());
            } else {
                $client = User::findOrFail($id);

                $input = $request->all();

                $client->update([
                    'name' => $input['name'],
                    'email' => $input['email'] ?? $client->email,
                    'mobile' => $input['mobile'],
                    'password' => $input['password'] ?? $client->password,
                    // You can update other fields as needed
                ]);

                return redirect()->route('clientpage')->with('success', 'Client updated successfully');
            }
        } catch (\Throwable $throwable) {
            \Log::error($throwable->getMessage());
            // dd($throwable->getMessage());
        }
    }


    public function deleteClient($id)
    {
        try {
            $client = User::findOrFail($id);
            $client->update(['is_deleted' => 1]);
            return response()->json(['message' => 'Client deleted successfully']);
        } catch (\Throwable $throwable) {
            dd($throwable->getMessage());
        }
    }
}
