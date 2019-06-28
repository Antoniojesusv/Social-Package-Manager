<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\src\MaSPack\Application\SocialPackage\Service\DetailSocialPackage;
use App\src\MaSPack\Application\SocialPackage\Command\DeleteSocialPackageCommand;
use App\src\MaSPack\Application\SocialPackage\CommandHandler\DeleteSocialPackageCommandHandler;
use App\src\MaSPack\Application\SocialPackage\Service\ListSocialPackages;
use App\src\MaSPack\Application\SocialPackage\Service\FindSocialPackage;
use App\src\MaSPack\Application\Subscription\Service\ListSubscriptions;

use App\src\MaSPack\Application\SocialPackage\Command\SaveSocialPackageCommand;
use App\src\MaSPack\Application\SocialPackage\Command\EditSocialPackageCommand;
use App\src\MaSPack\Application\SocialPackage\Command\SubscribeToSocialPackageCommand;

use App\src\MaSPack\Application\SocialPackage\CommandHandler\SaveSocialPackageCommandHandler;
use App\src\MaSPack\Application\SocialPackage\CommandHandler\EditSocialPackageCommandHandler;
use App\src\MaSPack\Application\SocialPackage\CommandHandler\SubscribeToSocialPackageCommandHandler;

use App\src\MaSPack\Application\Employee\Service\ListEmployees;

use App\src\MaSPack\Application\Exceptions\SocialPackageNotFoundException;
use App\src\MaSPack\Application\Exceptions\EmployeeNotFoundException;
use App\src\MaSPack\Application\Exceptions\InvalidDateFormatException;
use App\src\MaSPack\Domain\Exceptions\InvalidDateException;
use App\src\MaSPack\Domain\Exceptions\InvalidSubscriptionDateException;
use App\src\MaSPack\Domain\Exceptions\InvalidAmountException;

class SocialPackageController extends Controller
{
    private $listSocialPackages;
    private $findSocialPackage;
    private $saveSocialPackageCommandHandler;
    private $editSocialPackageCommandHandler;
    private $detailSocialPackageService;
    private $subscribeToSocialPackage;
    private $findSubscriptions;

    private $listEmployees;

    public function __construct(
        ListSocialPackages $listSocialPackages,
        FindSocialPackage $findSocialPackage,
        SaveSocialPackageCommandHandler $saveSocialPackageCommandHandler,
        EditSocialPackageCommandHandler $editSocialPackageCommandHandler,
        DetailSocialPackage $detailSocialPackageService,
        ListEmployees $listEmployees,
        SubscribeToSocialPackageCommandHandler $subscribeToSocialPackage,
        ListSubscriptions $findSubscriptions,
        DeleteSocialPackageCommandHandler $deleteSocialPackageCommandHandler
    ) {
        $this->middleware('auth');

        $this->listSocialPackages = $listSocialPackages;
        $this->findSocialPackage = $findSocialPackage;
        $this->saveSocialPackageCommandHandler = $saveSocialPackageCommandHandler;
        $this->editSocialPackageCommandHandler = $editSocialPackageCommandHandler;
        $this->detailSocialPackageService = $detailSocialPackageService;
        $this->deleteSocialPackageCommandHandler = $deleteSocialPackageCommandHandler;
        $this->subscribeToSocialPackage = $subscribeToSocialPackage;
        $this->findSubscriptions = $findSubscriptions;

        $this->listEmployees = $listEmployees;
    }

    /**
     * Display a listing the socialpackages.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socialPackagesCollection = $this->listSocialPackages->execute();

        return view('SocialPackageList')->with('socialPackagesCollection', $socialPackagesCollection);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $amount = $request->input('amount');

        try {
            $command = new SaveSocialPackageCommand(
                $name,
                $startDate,
                $endDate,
                (float) $amount,
                $description
            );
            $this->saveSocialPackageCommandHandler->handle($command);

            //redirect
            return redirect('SocialPackage');
        } catch (InvalidDateException $exception) {
            return view('CreateSocialPackage', [
                'errorMessage' => $exception->getMessage(),
                'name' => $name,
                'description' => $description,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'amount' => $amount]);
        } catch (InvalidAmountException $exception) {
            return view('CreateSocialPackage', [
                'errorMessage' => $exception->getMessage(),
                'name' => $name,
                'description' => $description,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'amount' => $amount]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailSocialPackage = $this->detailSocialPackageService->execute($id);
        $allEmployees = $this->listEmployees->execute();
        $subscriptions = $this->findSubscriptions->execute($id);

        return view('DetailSocialPackage')->with([
            'detailSocialPackage' => $detailSocialPackage,
            'allEmployees' => $allEmployees,
            'subscriptions' => $subscriptions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idCasted = $this->castToInt($id);

        try {
            $socialPackage = $this->findSocialPackage->execute($idCasted);
            return view('EditSocialPackage', compact('socialPackage'));
        } catch (SocialPackageNotFoundException $exception) {
            return $this->index()->with('errorMessage', $exception->getMessage());
        }
    }

    private function castToInt($variable): int
    {
        return (int) $variable;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $idCasted = $this->castToInt($id);

        try {
            $name = $request->input('name');
            $description = $request->input('description');
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');
            $amount = $request->input('amount');

            $command = new EditSocialPackageCommand($idCasted, $name, $description, $startDate, $endDate, (float) $amount);
            $this->editSocialPackageCommandHandler->handle($command);

            return redirect('SocialPackage');
        } catch (InvalidDateException $exception) {
            return $this->edit($idCasted)->with('errorMessage', $exception->getMessage());
        } catch (InvalidAmountException $exception) {
            return $this->edit($idCasted)->with('errorMessage', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $idCasted = $this->castToInt($id);

        $deleteCommand = new DeleteSocialPackageCommand($idCasted);

        try {
            $this->deleteSocialPackageCommandHandler->handle($deleteCommand);
        } catch (SocialPackageNotFoundException $e) {
            $error = ['title' => 'Social Package Error', 'message' => $e->getMessage()];
            return \redirect('SocialPackage')->with('toast', $error);
        }

        return \redirect('SocialPackage');
    }

    public function subscribe(Request $request, $id)
    {
        try {
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');
            $amount = $request->input('amount');
            foreach ($request->input('employees') as $employeeId) {
                $command = new SubscribeToSocialPackageCommand($id, $employeeId, $startDate, $endDate, $amount);
                $this->subscribeToSocialPackage->handle($command);
            }
            return $this->show($id);
        } catch (SocialPackageNotFoundException $exception) {
            return $this->show($id)->with('errorMessage', $exception->getMessage());
        } catch (EmployeeNotFoundException $exception) {
            return $this->show($id)->with('errorMessage', $exception->getMessage());
        } catch (InvalidDateFormatException $exception) {
            return $this->show($id)->with('errorMessage', $exception->getMessage());
        } catch (InvalidDateException $exception) {
            return $this->show($id)->with('errorMessage', $exception->getMessage());
        } catch (InvalidSubscriptionDateException $exception) {
            return $this->show($id)->with('errorMessage', $exception->getMessage());
        }
    }
}
